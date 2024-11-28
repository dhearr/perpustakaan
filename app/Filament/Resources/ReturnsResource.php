<?php

namespace App\Filament\Resources;

use stdClass;
use Carbon\Carbon;
use App\Models\Returns;
use Filament\Forms\Form;
use App\Models\Borrowing;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Cache;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ReturnsResource\Pages;

class ReturnsResource extends Resource
{
    protected static ?string $model = Returns::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('book_title')->label('Book')->disabled(),
                TextInput::make('member_name')->label('Member')->disabled(),
                DatePicker::make('date_loan')->label('Date Loan')->disabled(),
                DatePicker::make('date_due')->label('Date Due')->disabled(),
                DatePicker::make('date_return')->label('Date Return')->disabled(),
                TextInput::make('charge')->label('Charge')->disabled(),
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
                TextColumn::make('borrowing.book.title')->sortable()->searchable(),
                TextColumn::make('borrowing.member.name')->sortable()->searchable(),
                TextColumn::make('borrowing.date_loan')
                    ->label('Date loan')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->translatedFormat('l, d F Y') : '-'),
                TextColumn::make('borrowing.date_due')
                    ->label('Date due')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->translatedFormat('l, d F Y') : '-'),
                TextColumn::make('date_return')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->translatedFormat('l, d F Y') : '-'),
                BadgeColumn::make('charge')
                    ->sortable()
                    ->searchable()
                    ->icon(fn($state) => $state == 0 ? 'heroicon-o-check-circle' : 'heroicon-o-banknotes')
                    ->colors([
                        'success' => fn($state) => $state == 0,
                        'danger' => fn($state) => $state > 0,
                    ])
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                BadgeColumn::make('borrowing.status')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => $state === 'dikembalikan' ? 'Dikembalikan' : '-')
                    ->icon(fn($state) => $state === 'dikembalikan' ? 'heroicon-o-check-circle' : null)
                    ->colors([
                        'success' => fn($state) => $state === 'dikembalikan',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->color('info'),
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
        $returnedCount = Cache::remember('returns_badge_count', now()->addMinutes(5), function () {
            return static::getModel()::with('borrowing')
                ->whereHas('borrowing', function ($query) {
                    $query->where('status', 'dikembalikan');
                })->count();
        });

        return $returnedCount > 0 ? (string) $returnedCount : null;
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
            'index' => Pages\ListReturns::route('/'),
            'create' => Pages\CreateReturns::route('/create'),
            'view' => Pages\ViewReturns::route('/{record}')
        ];
    }
}
