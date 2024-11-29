<?php

namespace App\Filament\Resources;

use stdClass;
use App\Models\Book;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BookResource\Pages\ListBooks;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Book Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->afterStateUpdated(fn($state, callable $set) => $set('title', Str::title($state))),
                TextInput::make('writer')
                    ->required()
                    ->afterStateUpdated(fn($state, callable $set) => $set('writer', Str::title($state))),
                TextInput::make('publisher')
                    ->required()
                    ->afterStateUpdated(fn($state, callable $set) => $set('publisher', Str::title($state))),
                TextInput::make('publication_year')->required()->numeric(),
                Select::make('rack_id')
                    ->relationship('rack', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                Select::make('status')
                    ->default('tersedia')
                    ->disabled(fn(string $context) => $context === 'create')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'dipinjam' => 'Dipinjam',
                        'hilang' => 'Hilang'
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
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('writer')->sortable()->searchable(),
                TextColumn::make('publisher')->sortable()->searchable(),
                TextColumn::make('publication_year')->sortable()->searchable(),
                TextColumn::make('rack.name')->sortable()->searchable(),
                BadgeColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'tersedia' => 'Tersedia',
                            'dipinjam' => 'Dipinjam',
                            'hilang' => 'Hilang',
                        };
                    })
                    ->icon(fn($state) => match ($state) {
                        'tersedia' => 'heroicon-o-check-circle',
                        'dipinjam' => 'heroicon-o-clock',
                        'hilang' => 'heroicon-o-x-circle',
                    })
                    ->colors([
                        'success' => fn($state) => $state === 'tersedia',
                        'warning' => fn($state) => $state === 'dipinjam',
                        'danger' => fn($state) => $state === 'hilang',
                    ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'dipinjam' => 'Dipinjam',
                        'hilang' => 'Hilang',
                    ])
            ])
            ->actions([
                ViewAction::make()
                    ->color('info'),
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListBooks::route('/'),
        ];
    }
}
