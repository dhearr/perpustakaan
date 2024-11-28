<?php

namespace App\Filament\Resources\BorrowingResource\Widgets;

use App\Models\Borrowing;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Mengambil data jumlah buku berdasarkan status
        $statuses = [
            'Dipinjam' => 'Total Books Borrowed',
            'Dikembalikan' => 'Total Books Returned',
        ];

        // Menambahkan jumlah total buku
        $stats = [
            Stat::make('Total Loan', Borrowing::count())
                ->description('Loan amount')
                ->descriptionIcon('heroicon-o-user')
                ->color('info')
        ];

        // Loop untuk menambahkan stat berdasarkan status
        foreach ($statuses as $status => $label) {
            $stats[] = Stat::make($label, Borrowing::where('status', $status)->count())
                ->description("Amount book")
                ->descriptionIcon('heroicon-o-book-open')
                ->color($status === 'Dipinjam' ? 'primary' : 'success');
        }

        return $stats;
    }

}
