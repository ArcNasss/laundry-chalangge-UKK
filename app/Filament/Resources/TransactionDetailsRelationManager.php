<?php

namespace App\Filament\Resources\TransactionResource\RelationManagers;

use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactionDetails';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('package_id')
                ->label('Paket Laundry')
                ->options(Package::all()->pluck('nama_paket', 'id'))
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                    $package = Package::find($state);
                    if ($package) {
                        $set('harga_satuan', $package->harga);
                        $set('subtotal', $package->harga * ($get('qty') ?? 1));
                    }
                })
                ->columnSpan(2),
                
            Forms\Components\TextInput::make('qty')
                ->label('Quantity')
                ->numeric()
                ->default(1)
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                    $set('subtotal', $get('harga_satuan') * $state);
                }),
                
            Forms\Components\TextInput::make('harga_satuan')
                ->label('Harga Satuan')
                ->numeric()
                ->disabled()
                ->dehydrated()
                ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),
                
            Forms\Components\TextInput::make('subtotal')
                ->label('Subtotal')
                ->numeric()
                ->disabled()
                ->dehydrated()
                ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),
                
            Forms\Components\Textarea::make('keterangan_diskon')
                ->label('Keterangan Diskon')
                ->columnSpanFull()
                ->placeholder('Contoh: Diskon Hari Raya 10%, Diskon Member Baru 20%'),
        ])
        ->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.nama_paket')
                    ->label('Paket')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('package.jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'kiloan' => 'info',
                        'selimut' => 'warning',
                        'bed_cover' => 'success',
                        'kaos' => 'danger',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->money('IDR')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('qty')
                    ->label('Qty')
                    ->numeric()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->money('IDR')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('keterangan_diskon')
                    ->label('Keterangan Diskon')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('package')
                    ->relationship('package', 'nama_paket')
                    ->searchable()
                    ->preload(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function ($livewire) {
                        $livewire->dispatch('refreshTransactionTotal');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($livewire) {
                        $livewire->dispatch('refreshTransactionTotal');
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($livewire) {
                        $livewire->dispatch('refreshTransactionTotal');
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function ($livewire) {
                            $livewire->dispatch('refreshTransactionTotal');
                        }),
                ]),
            ]);
    }

    
}

