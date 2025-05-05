<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Package;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_non_member')
                ->label('Pelanggan Bukan Member?')
                ->live(),

                Select::make('outlet_id')
                    ->label('Outlet')
                    ->relationship('outlet', 'name')
                    ->searchable()
                    ->required()
                    ->live()->preload()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $set('invoice_code', self::generateInvoiceCode($state));
                    }),

                    Select::make('member_id')
                    ->label('Member')
                    ->relationship('member', 'nama')
                    ->searchable()
                    ->required(fn ($get) => !$get('is_non_member'))
                    ->visible(fn ($get) => !$get('is_non_member'))
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                        $set('invoice_code', self::generateInvoiceCode($get('outlet_id'), $state));
                    }),

                    Forms\Components\TextInput::make('non_member_name')
                    ->label('Nama Non-Member')
                    ->required(fn ($get) => $get('is_non_member'))
                    ->visible(fn ($get) => $get('is_non_member'))
                    ->dehydrated(fn ($get) => $get('is_non_member')),



                Forms\Components\TextInput::make('invoice_code')
                    ->label('Invoice Code')
                    ->default(function ($get) {
                        return self::generateInvoiceCode($get('outlet_id'), $get('member_id'));
                    })
                    ->disabled()
                    ->dehydrated(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'baru' => 'Baru',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->default(now()),

                Forms\Components\DatePicker::make('batas_waktu')
                    ->label('Batas Waktu')
                    ->required()
                    ->default(now()->addDays(3)),

                Forms\Components\Select::make('diskon')
                    ->label('Diskon (%)')
                    ->options([
                        '0' => 'Tidak Ada Diskon',
                        '10' => 'Diskon Hari Raya 10%',
                        '20' => 'Diskon Pengguna Baru 20%',
                        '30' => 'Diskon Spesial 30%',
                        '50' => 'Diskon Besar 50%',
                    ])
                    ->default('0')
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                        self::calculateTotal($set, $get);
                    }),

                Forms\Components\Select::make('dibayar')
                    ->label('Status Pembayaran')
                    ->options([
                        'lunas' => 'Lunas',
                        'belum_dibayar' => 'Belum Dibayar',
                    ])
                    ->required()
                    ->default('belum_dibayar'),

                Forms\Components\DatePicker::make('tanggal_bayar')
                    ->label('Tanggal Bayar')
                    ->nullable()
                    ->visible(fn ($get) => $get('dibayar') === 'lunas'),

                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),

                Repeater::make('transactionDetails')
                    ->relationship()
                    ->schema([
                        Select::make('package_id')
                            ->label('Paket Laundry')
                            ->options(Package::all()->pluck('nama_paket', 'id'))
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                                $package = Package::find($state);
                                if ($package) {
                                    $set('harga_satuan', $package->harga);
                                }
                                self::calculateTotal($set, $get);
                            }),

                        Forms\Components\TextInput::make('harga_satuan')
                            ->label('Harga Satuan')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),

                            Forms\Components\TextInput::make('harga_setelah_pajak')
                            ->label('Harga Setelah Pajak')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),


                        Forms\Components\TextInput::make('qty')
                            ->label('Quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                                self::calculateTotal($set, $get);
                            }),

                        Forms\Components\TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),

                        Forms\Components\Textarea::make('message')
                            ->label('Keterangan')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                        self::calculateTotal($set, $get);
                    }),
            ]);
    }

    private static function calculateTotal($set, $get)
{
    $details = $get('transactionDetails');
    $diskon = (int) $get('diskon');

    $total = 0;

    // Ambil persentase pajak (anggap hanya 1 data di tabel taxes)
    $pajak = \App\Models\Tax::first();
    $persenPajak = $pajak ? $pajak->percentage : 0;

    if (is_array($details)) {
        foreach ($details as $index => $detail) {
            if (!empty($detail['package_id']) && !empty($detail['qty'])) {
                $package = Package::find($detail['package_id']);
                $hargaAsli = $package ? $package->harga : 0;

                // Hitung harga setelah pajak
                $hargaDenganPajak = $hargaAsli + ($hargaAsli * $persenPajak / 100);

                $qty = (int) $detail['qty'];
                $subtotal = $hargaDenganPajak * $qty;
                $total += $subtotal;

                // Set harga setelah pajak & subtotal
                $set("transactionDetails.$index.harga_setelah_pajak", $hargaDenganPajak);
                $set("transactionDetails.$index.subtotal", $subtotal);
            }
        }


    }

    // Hitung diskon dari total (jika ada)
    $totalSetelahDiskon = $total - ($total * $diskon / 100);

    $set('total_harga', $totalSetelahDiskon);
}



protected static function updateTransactionTotal($record)
{
    $pajak = \App\Models\Tax::first();
    $persenPajak = $pajak ? $pajak->percentage : 0;

    $total = 0;

    foreach ($record->transactionDetails as $detail) {
        $package = $detail->package;
        if ($package) {
            $hargaAsli = $package->harga;
            $hargaDenganPajak = $hargaAsli + ($hargaAsli * $persenPajak / 100);
            $subtotal = $hargaDenganPajak * $detail->qty;

            $total += $subtotal;

            $detail->update(['subtotal' => $subtotal]);
        }
    }

    $diskon = $record->diskon ?? 0;
    $totalSetelahDiskon = $total - ($total * $diskon / 100);

    $record->update(['total_harga' => $totalSetelahDiskon]);

}

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['is_non_member'] ?? false) {
            $nonMember = \App\Models\NonMember::create([
                'nama' => $data['non_member_name'],
            ]);

            $data['non_member_id'] = $nonMember->id;
            $data['member_id'] = null;
        }

        return $data;
    }




    public static function afterCreate($record)
    {
        self::updateTransactionTotal($record);
    }

    public static function afterSave($record)
    {
        self::updateTransactionTotal($record);
    }

    private static function generateInvoiceCode($outletId, $memberId = null)
    {
        if (!$outletId) return null;

        $timestamp = now()->format('YmdHis');
        $memberPart = $memberId ? $memberId . '-' : '';

        return 'INV-' . $outletId . '-' . $memberPart . $timestamp;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_code')
                    ->label('Invoice')
                    ->searchable(),

                Tables\Columns\TextColumn::make('outlet.name')
                    ->label('Outlet')
                    ->sortable(),

                    Tables\Columns\TextColumn::make('nonMember.nama')
                    ->label('Non-Member')
                    ->formatStateUsing(fn ($state) => $state ?? '-'),


                Tables\Columns\TextColumn::make('member.nama')
                    ->label('Member')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baru' => 'info',
                        'proses' => 'warning',
                        'selesai' => 'success',
                        'belum_dibayar' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('dibayar')
                    ->label('Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'lunas' => 'success',
                        'belum_dibayar' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('diskon')
                    ->label('Diskon')
                    ->suffix('%'),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->numeric()
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->suffix(''),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date(),

                Tables\Columns\TextColumn::make('batas_waktu')
                    ->label('Batas Waktu')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'baru' => 'Baru',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                        'belum_dibayar' => 'Belum Dibayar',
                    ]),

                Tables\Filters\SelectFilter::make('dibayar')
                    ->options([
                        'lunas' => 'Lunas',
                        'belum_dibayar' => 'Belum Dibayar',
                    ]),

                Tables\Filters\SelectFilter::make('diskon')
                    ->options([
                        '0' => 'Tidak Ada Diskon',
                        '10' => 'Diskon Hari Raya 10%',
                        '20' => 'Diskon Pengguna Baru 20%',
                        '30' => 'Diskon Spesial 30%',
                        '50' => 'Diskon Besar 50%',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Transaction $record): string => route('admin.transactions.download.single', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('downloadSelected')
                        ->label('Download Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (Collection $records) {
                            $ids = $records->pluck('id')->implode(',');
                            return redirect()->route('admin.transactions.download.all', ['ids' => $ids]);
                        }),
                         Tables\Actions\BulkAction::make('downloadAll')
                        ->label('Download All Transactions')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function () {
                            return redirect()->route('admin.transactions.download.all');
                        }),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('downloadAllHeader')
                    ->label('Download All Transactions')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(route('admin.transactions.download.all'))
                    ->openUrlInNewTab(),
            ]);

    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TransactionDetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole(['admin','kasir','owner']);
    }
}
