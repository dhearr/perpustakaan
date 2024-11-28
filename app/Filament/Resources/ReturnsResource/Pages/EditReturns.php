<?php

namespace App\Filament\Resources\ReturnsResource\Pages;

use App\Filament\Resources\ReturnsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReturns extends EditRecord
{
    protected static string $resource = ReturnsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
