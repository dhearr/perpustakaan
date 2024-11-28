<?php

namespace App\Filament\Widgets;

use App\Models\Borrowing;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class BookBorrowingChart extends ChartWidget
{
    protected static ?string $heading = 'Book Borrowing Chart';

    /**
     * Mengembalikan data untuk chart
     */
    protected function getData(): array
    {
        // Inisialisasi array bulan dengan nilai 0
        $monthlyBorrowing = array_fill(1, 12, 0);

        // Ambil data peminjaman dari database
        $borrowings = Borrowing::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Isi data ke dalam array bulan
        foreach ($borrowings as $month => $count) {
            $monthlyBorrowing[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Books Borrowed',
                    'data' => array_values($monthlyBorrowing),
                    'borderWidth' => 1,
                ],
            ],
            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
        ];
    }

    /**
     * Tipe chart: Bar Chart
     */
    protected function getType(): string
    {
        return 'bar';
    }
}
