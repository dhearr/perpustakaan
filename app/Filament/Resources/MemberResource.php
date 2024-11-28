<?php

namespace App\Filament\Resources;

use stdClass;
use App\Models\Member;
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
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\MemberResource\Pages\ListMembers;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Member Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->afterStateUpdated(fn($state, callable $set) => $set('name', Str::title($state))),
                TextInput::make('email')
                    ->required(),
                TextInput::make('address')
                    ->helperText('Contoh: Jln. Perpustakaan No.123 Rt.45 Rw.67 Tasikmalaya Jawa Barat')
                    ->required()
                    ->afterStateUpdated(fn($state, callable $set) => $set('address', Str::title($state))),
                TextInput::make('no_phone')->required(),
                Select::make('gender')
                    ->options([
                        'laki-laki' => 'Laki-Laki',
                        'perempuan' => 'Perempuan'
                    ])->required()
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
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
                TextColumn::make('no_phone')->sortable()->searchable(),
                BadgeColumn::make('gender')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'laki-laki' => 'Laki-Laki',
                            'perempuan' => 'Perempuan',
                        };
                    })
                    ->icon(fn($state) => match ($state) {
                        'laki-laki' => 'heroicon-o-user-circle',
                        'perempuan' => 'heroicon-o-user-circle',
                    })
                    ->colors([
                        'info' => fn($state) => $state === 'laki-laki',
                        'pingky' => fn($state) => $state === 'perempuan',
                    ]),
            ])
            ->filters([
                //
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
            'index' => ListMembers::route('/'),
        ];
    }
}
