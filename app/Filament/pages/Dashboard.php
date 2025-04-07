<?php

namespace App\Filament\Pages;

use App\Models\Transaction;
use App\Models\Member;
use App\Models\Package;
use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Filament\Widgets\LatestTransactionsWidget;
use App\Filament\Widgets\TransactionChartWidget;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
{
    return [
        StatsOverviewWidget::class, 
    ];
}


   
    protected function getWidgets(): array
    {
        return [
            // TransactionChartWidget::class,
            LatestTransactionsWidget::class,
        ];
    }
}