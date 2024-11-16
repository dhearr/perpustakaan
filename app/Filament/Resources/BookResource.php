<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages\CreateBook;
use App\Filament\Resources\BookResource\Pages\EditBook;
use App\Filament\Resources\BookResource\Pages\ListBooks;
use App\Filament\Resources\BookResource\Pages\ViewBook;
use App\Models\Book;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Judul Buku')->required(),
                TextInput::make('writer')->label('Penulis')->required(),
                TextInput::make('publisher')->label('Penerbit')->required(),
                TextInput::make('publication_year')->label('Tahun Terbit')->required()->numeric(),
                Select::make('status')
                    ->label('Status')
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
                TextColumn::make('title')->label('Judul Buku')->sortable()->searchable(),
                TextColumn::make('writer')->label('penulis')->sortable()->searchable(),
                TextColumn::make('publisher')->label('Penerbit')->sortable()->searchable(),
                TextColumn::make('publication_year')->label('Tahun Terbit')->sortable()->searchable(),
                BadgeColumn::make('status')
                    ->label('Status')
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
                    ])->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->color('info'),
                EditAction::make(),
                DeleteAction::make()
                    ->successNotificationTitle('Buku berhasil dihapus')
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'create' => CreateBook::route('/create'),
            'view' => ViewBook::route('/{record}'),
            'edit' => EditBook::route('/{record}/edit'),
        ];
    }
}
