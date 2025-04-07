<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\Package;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transaksi', Transaction::count())
                ->description('Semua transaksi')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('success'),

            // Stat::make('Transaksi Bulan Ini', Transaction::whereMonth('tanggal', now()->month)->count())
            //     ->description('Peningkatan ' . $this->getPercentageIncrease() . '% dari bulan lalu')
            //     ->descriptionIcon($this->getPercentageIncrease() >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
            //     ->color($this->getPercentageIncrease() >= 0 ? 'success' : 'danger'),

            Stat::make('Total Member', Member::count())
                ->description('Member aktif')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Paket Terpopuler', Package::withCount('transactionDetails')
                ->orderBy('transaction_details_count', 'desc')
                ->first()->nama_paket ?? '-')
                ->description('Paling banyak dipilih')
                ->descriptionIcon('heroicon-o-star')
                ->color('warning'),
        ];
    }

    private function getPercentageIncrease(): float
    {
        $currentMonthCount = Transaction::whereMonth('tanggal', now()->month)->count();
        $lastMonthCount = Transaction::whereMonth('tanggal', now()->subMonth()->month)->count();
        
        if ($lastMonthCount === 0) return 0;
        
        return round(($currentMonthCount - $lastMonthCount) / $lastMonthCount * 100, 2);
    }
}
