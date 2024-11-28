<?php

namespace App\Filament\Resources;

use stdClass;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Borrowing;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BorrowingExport;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\ReportResource\Pages;

class ReportResource extends Resource
{
    protected static ?string $model = Borrowing::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Reports';
    protected static ?string $label = 'Reports';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                )->sortable(),
                TextColumn::make('book.title'),
                TextColumn::make('member.name'),
                TextColumn::make('date_loan')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('l, d F Y')),
                TextColumn::make('date_due')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('l, d F Y')),
            ])
            ->filters([
                Filter::make('Tanggal Peminjaman')
                    ->form([
                        DatePicker::make('date'),
                    ])
                    ->query(function ($query, array $data) {
                        if (empty($data['date'])) {
                            return $query->whereRaw('1 = 0');
                        }

                        return $query->whereDate('date_loan', $data['date']);
                    })
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
            ->headerActions([
                Action::make('Print Report')
                    ->label('Print Report')
                    ->color('primary')
                    ->icon('heroicon-o-printer')
                    ->disabled(function ($livewire) {
                        $filters = $livewire->tableFilters;
                        return empty($filters['Tanggal Peminjaman']['date']);
                    })
                    ->action(function (array $data, $livewire) {
                        Carbon::setLocale('id');
                        $filters = $livewire->tableFilters;

                        // Validasi filter tanggal
                        if (empty($filters['Tanggal Peminjaman']['date'])) {
                            return;
                        }

                        $selectedDate = $filters['Tanggal Peminjaman']['date'];
                        $formattedDate = Carbon::parse($selectedDate)->translatedFormat('l, d F Y');

                        // Pilihan format file
                        if ($data['type'] === 'pdf') {
                            // Query data
                            $query = Borrowing::query();
                            $query->whereDate('date_loan', $selectedDate);
                            $records = $query->get();

                            // Buat PDF
                            $pdf = Pdf::loadView('filament.pages.template-report-pdf', compact('records', 'formattedDate'));
                            $fileName = 'laporan-peminjaman-' . Str::slug(str_replace([',', ' '], '-', $formattedDate)) . '.pdf';

                            return response()->streamDownload(fn() => print ($pdf->output()), $fileName);
                        } elseif ($data['type'] === 'excel') {
                            // Buat Excel
                            $export = new BorrowingExport($filters);
                            $fileName = 'laporan-peminjaman-' . Str::slug(str_replace([',', ' '], '-', $formattedDate)) . '.xlsx';

                            return Excel::download($export, $fileName);
                        }
                    })
                    ->form([
                        Select::make('type')
                            ->label('Format File')
                            ->options([
                                'pdf' => 'PDF',
                                'excel' => 'Excel',
                            ])
                            ->required(),
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
        ];
    }
}
