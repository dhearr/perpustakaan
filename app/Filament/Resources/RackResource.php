<?php

namespace App\Filament\Resources;

use stdClass;
use App\Models\Rack;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\RackResource\Pages\ListRacks;

class RackResource extends Resource
{
    protected static ?string $model = Rack::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->helperText("Example: Rack-1 , Don't use spaces to create Rack names!")
                    ->regex('/^[\w-]+$/')
                    ->required()
                    ->afterStateUpdated(fn($state, callable $set) => $set('name', Str::title($state)))
                    ->unique(Rack::class, 'name', ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Name is already in use, use another name.'
                    ])
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
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('books_count')
                    ->counts('books')
                    ->default(0)
                    ->formatStateUsing(fn(?string $state) => $state ?? 0),
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make()
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
            'index' => ListRacks::route('/'),
        ];
    }
}
