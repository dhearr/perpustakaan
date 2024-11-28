<?php

namespace App\Filament\Resources\ReturnsResource\Widgets;

use App\Models\Returns;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalReturns = Returns::count();
        $lateReturns = Returns::whereHas('borrowing', function ($query) {
            $query->whereColumn('returns.date_return', '>', 'borrowings.date_due');
        })->count();
        $charge = Returns::sum('charge');
        $formattedCharge = 'Rp ' . number_format($charge, 0, ',', '.') . ',-';

        return [
            Stat::make('Returned Book', $totalReturns)
                ->description('Total returned book')
                ->descriptionIcon('heroicon-o-arrow-path')
                ->color('info'),

            Stat::make('Late Return', $lateReturns)
                ->description('Late returned books')
                ->descriptionIcon('heroicon-o-clock')
                ->color('primary'),

            Stat::make('Total Charge', $formattedCharge)
                ->description('Amount of late fine')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success'),
        ];
    }

}
