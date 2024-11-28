<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BorrowingExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    /**
     * Ambil koleksi data untuk diekspor
     */
    public function collection()
    {
        $query = Borrowing::query();

        if (!empty($this->filters['Tanggal Peminjaman']['date'])) {
            $query->whereDate('date_loan', $this->filters['Tanggal Peminjaman']['date']);
        }

        return $query->get();
    }

    /**
     * Judul kolom Excel
     */
    public function headings(): array
    {
        return [
            'Buku',
            'Member',
            'Tanggal Peminjaman',
            'Rencana Tanggal Pengembalian',
        ];
    }

    /**
     * Format setiap baris data
     */
    public function map($row): array
    {
        Carbon::setLocale('id');

        return [
            $row->book->title,
            $row->member->name,
            Carbon::parse($row->date_loan)->translatedFormat('l, d F Y'),
            Carbon::parse($row->date_due)->translatedFormat('l, d F Y'),
        ];
    }
}
