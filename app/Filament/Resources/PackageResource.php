<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                TextInput::make('nama_paket'),
                Select::make('outlet_id')->label('outlet')->relationship('outlet','name')->searchable()->preload(),
                Select::make('jenis')
                    ->options([
                        'kiloan' => 'Kiloan',
                        'selimut' => 'Selimut',
                        'bed_cover' => 'Bed Cover',
                        'kaos' => 'Kaos',
                        'lain-lain' => 'Lain-lain'
                    ]),
                TextInput::make('harga')->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_paket')->label('Nama Paket')->searchable(),
                TextColumn::make('jenis')->label('Jenis')->sortable(),
                TextColumn::make('outlet.name')->label('Outlet')->searchable()->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }


   

public static function canViewAny(): bool

    {
        $user = Filament::auth()->user();

          return auth()->user()->hasAnyRole(['admin', 'kasir', 'owner']);
    }


}
