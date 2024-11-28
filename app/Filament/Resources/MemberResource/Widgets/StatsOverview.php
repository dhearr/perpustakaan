<?php

namespace App\Filament\Resources\MemberResource\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Mengambil data jumlah buku berdasarkan status
        $genders = [
            'Laki-Laki' => 'Member Male',
            'Perempuan' => 'Member Female',
        ];

        $stats = [
            Stat::make('Total Member', Member::count())
                ->description('All member in library')
                ->descriptionIcon('heroicon-o-user')
                ->color('success')
        ];

        foreach ($genders as $gender => $label) {
            $stats[] = Stat::make($label, Member::where('gender', $gender)->count())
                ->description("Total member")
                ->descriptionIcon('heroicon-o-user')
                ->color($gender === 'Laki-Laki' ? 'info' : 'pingky');
        }

        return $stats;
    }

}
