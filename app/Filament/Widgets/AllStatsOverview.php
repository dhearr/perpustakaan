<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Rack;
use App\Models\Returns;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AllStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Data konfigurasi
        $stats = [
            [
                'title' => 'Total Book',
                'value' => Book::count(),
                'description' => 'Books in library',
                'icon' => 'heroicon-o-book-open',
            ],
            [
                'title' => 'Total Book Borrowed',
                'value' => Borrowing::count(),
                'description' => 'Total books borrowed',
                'icon' => 'heroicon-o-check-circle',
            ],
            [
                'title' => 'Total Members',
                'value' => Member::count(),
                'description' => 'Members in library',
                'icon' => 'heroicon-o-user',
            ],
            [
                'title' => 'Book Available',
                'value' => Book::where('status', 'Tersedia')->count(),
                'description' => 'Books available',
                'icon' => 'heroicon-o-check-circle',
            ],
            [
                'title' => 'Book Returned',
                'value' => Returns::whereHas('borrowing', function ($query) {
                    $query->where('status', 'dikembalikan');
                })->count(),
                'description' => 'Books returned',
                'icon' => 'heroicon-o-arrow-path',
            ],
            [
                'title' => 'Books Lost',
                'value' => Book::where('status', 'Hilang')->count(),
                'description' => 'Books reported lost',
                'icon' => 'heroicon-o-exclamation-circle',
            ],
            [
                'title' => 'Total Rack',
                'value' => Rack::count(),
                'description' => 'Racks book',
                'icon' => 'heroicon-o-server-stack',
            ],
            [
                'title' => 'Total Charge',
                'value' => 'Rp ' . number_format(Returns::sum('charge'), 0, ',', '.') . ',-',
                'description' => 'Late charge',
                'icon' => 'heroicon-o-banknotes',
            ],
            [
                'title' => 'Books with Fines',
                'value' => Returns::where('charge', '>', 0)->count(),
                'description' => 'Books with fines applied',
                'icon' => 'heroicon-o-tag',
            ],
        ];

        // Generate Stat objects
        return collect($stats)->map(
            fn($stat) => Stat::make($stat['title'], $stat['value'])
                ->description($stat['description'])
                ->descriptionIcon($stat['icon'])
                ->color('primary')
        )->toArray();
    }
}
