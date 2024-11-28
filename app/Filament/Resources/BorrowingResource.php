<?php

namespace App\Filament\Resources;

use stdClass;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Returns;
use Filament\Forms\Form;
use App\Models\Borrowing;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Cache;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BorrowingResource\Pages\ListBorrowings;
use App\Filament\Resources\BorrowingResource\Pages\CreateBorrowing;

class BorrowingResource extends Resource
{
    protected static ?string $model = Borrowing::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('book_id')
                    ->relationship('book', 'title')
                    ->searchable()
                    ->preload()
                    ->options(function (?Model $record) {
                        $query = Book::query();

                        // Jika sedang edit atau view, tambahkan buku yang sedang dipilih
                        if ($record && $record->book_id) {
                            $query->orWhere('id', $record->book_id);
                        }

                        // Tetap filter buku yang statusnya "Tersedia"
                        $query->orWhere('status', 'Tersedia');

                        return $query->pluck('title', 'id');
                    })
                    ->disabled(fn(?Model $record) => !is_null($record))
                    ->required(),
                Select::make('member_id')
                    ->searchable()
                    ->preload()
                    ->relationship('member', 'name')
                    ->disabled(fn(?Model $record) => !is_null($record))
                    ->required(),
                DatePicker::make('date_loan')
                    ->default(now())
                    ->required(),
                DatePicker::make('date_due')
                    ->required()
                    ->rules(['after_or_equal:date_loan']),
                Select::make('status')
                    ->default('dipinjam')
                    ->disabled(fn(string $context) => $context === 'create')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                    ])->required(),
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
                TextColumn::make('book.title')->sortable()->searchable(),
                TextColumn::make('member.name')->sortable()->searchable(),
                TextColumn::make('date_loan')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('l, d F Y')),
                TextColumn::make('date_due')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('l, d F Y')),
                BadgeColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'dipinjam' => 'Dipinjam',
                            'dikembalikan' => 'Dikembalikan'
                        };
                    })
                    ->icon(fn($state) => match ($state) {
                        'dipinjam' => 'heroicon-o-clock',
                        'dikembalikan' => 'heroicon-o-check-circle'
                    })
                    ->colors([
                        'warning' => fn($state) => $state === 'dipinjam',
                        'success' => fn($state) => $state === 'dikembalikan',
                    ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'dikembalikan' => 'Dikembalikan',
                        'dipinjam' => 'Dipinjam',
                    ])
            ])
            ->actions([
                ViewAction::make()
                    ->color('info'),
                EditAction::make(),
                Action::make('prosesPengembalian')
                    ->label('Return')
                    ->color('success')
                    ->icon('heroicon-o-arrow-path')
                    ->action(function (Borrowing $record, array $data) {
                        $record->update(['status' => 'dikembalikan']);

                        Returns::create([
                            'borrowing_id' => $record->id,
                            'date_return' => now(),
                            'charge' => 0,
                        ]);

                        Notification::make()
                            ->title('Return success.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->visible(fn(Borrowing $record) => $record->status === 'dipinjam'),
                DeleteAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        $borrowedCount = Borrowing::where('status', 'dipinjam')->count();

        return $borrowedCount > 0 ? (string) $borrowedCount : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
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
            'index' => ListBorrowings::route('/'),
            'create' => CreateBorrowing::route('/create')
        ];
    }
}
