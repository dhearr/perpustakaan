<?php

namespace App\Filament\Resources\BookResource\Widgets;

use App\Models\Book;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Mengambil data jumlah buku berdasarkan status
        $statuses = [
            'Dipinjam' => 'Total Books Borrowed',
            'Tersedia' => 'Total Books Available',
        ];

        $stats = [
            Stat::make('Total Books', Book::count())
                ->description('All books')
                ->descriptionIcon('heroicon-o-book-open')
                ->color('info')
        ];

        foreach ($statuses as $status => $label) {
            $stats[] = Stat::make($label, Book::where('status', $status)->count())
                ->description("Amount book")
                ->descriptionIcon('heroicon-o-book-open')
                ->color($status === 'Dipinjam' ? 'primary' : 'success');
        }

        return $stats;
    }

}
