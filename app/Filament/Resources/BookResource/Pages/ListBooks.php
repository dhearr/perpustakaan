<?php

namespace App\Filament\Resources\BookResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\BookResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BookResource\Widgets\StatsOverview;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
