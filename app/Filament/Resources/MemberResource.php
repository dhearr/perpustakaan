<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages\CreateMember;
use App\Filament\Resources\MemberResource\Pages\EditMember;
use App\Filament\Resources\MemberResource\Pages\ListMembers;
use App\Filament\Resources\MemberResource\Pages\ViewMember;
use App\Models\Member;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama')->required(),
                TextInput::make('address')->label('Alamat')->required(),
                TextInput::make('no_phone')->label('No Hanphone')->required(),
                Select::make('gender')
                    ->label('Jenis Kelamin')
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
                TextColumn::make('name')->label('Nama')->sortable()->searchable(),
                TextColumn::make('address')->label('Alamat')->sortable()->searchable(),
                TextColumn::make('no_phone')->label('No Hanphone')->sortable()->searchable(),
                BadgeColumn::make('gender')
                    ->label('Jenis Kelamin')
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
                    ->successNotificationTitle('Member berhasil dihapus')
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
            'index' => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'view' => ViewMember::route('/{record}'),
            'edit' => EditMember::route('/{record}/edit'),
        ];
    }
}
