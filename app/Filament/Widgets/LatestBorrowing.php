<?php

namespace App\Filament\Widgets;

use App\Models\Borrowing;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\IconColumn;

class LatestBorrowing extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        // Query untuk menampilkan data peminjaman yang sedang berlangsung
        return Borrowing::query()
            ->where('status', 'Dipinjam')
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('member.name')
                ->label('Name')
                ->searchable(),
            TextColumn::make('book.title')
                ->label('Book')
                ->searchable(),
            TextColumn::make('date_loan')
                ->label('Date loan')
                ->date(),
            TextColumn::make('date_due')
                ->label('Date due')
                ->date(),
            IconColumn::make('status')
                ->options([
                    'heroicon-m-stop',
                ])
                ->colors([
                    'success',
                ])
                ->size('md')
                ->alignment('center'),
        ];
    }
}
