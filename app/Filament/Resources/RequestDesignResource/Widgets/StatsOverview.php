<?php

namespace App\Filament\Resources\RequestDesignResource\Widgets;

use App\Models\RequestDesign;
use App\Models\Result;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('All Request', RequestDesign::all()->count()),
            // ->description('Telah dibuat')
            // ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('On Progress', Result::where('status', 'On progress')->count()),
            Stat::make('Waiting list request', Result::where('status', 'Mohon menunggu')->count()),
        ];
    }
}
