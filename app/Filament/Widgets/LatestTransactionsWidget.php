<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestTransactionsWidget extends TableWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): string
    {
        return 'Transaksi Terbaru';
    }

    protected function getTableQuery(): Builder
    {
        return Transaction::query()
            ->with(['member', 'outlet'])
            ->latest()
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('invoice_code')
                ->label('Invoice')
                ->searchable(),
                
            Tables\Columns\TextColumn::make('member.nama')
                ->label('Member'),
                
            Tables\Columns\TextColumn::make('outlet.name')
                ->label('Outlet'),
                
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'baru' => 'info',
                    'proses' => 'warning',
                    'selesai' => 'success',
                }),
                
            Tables\Columns\TextColumn::make('total_harga')
                ->money('IDR'),
                
            Tables\Columns\TextColumn::make('tanggal')
                ->date(),
        ];
    }
}