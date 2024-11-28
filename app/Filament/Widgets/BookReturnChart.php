<?php

namespace App\Filament\Widgets;

use App\Models\Returns;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class BookReturnChart extends ChartWidget
{
    protected static ?string $heading = 'Book Return Chart';

    /**
     * Mengembalikan data untuk chart
     */
    protected function getData(): array
    {
        // Inisialisasi array bulan dengan nilai 0
        $monthlyReturns = array_fill(1, 12, 0);

        // Ambil data pengembalian dari database
        $returns = Returns::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Isi data ke dalam array bulan
        foreach ($returns as $month => $count) {
            $monthlyReturns[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Books Returned',
                    'data' => array_values($monthlyReturns),
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
