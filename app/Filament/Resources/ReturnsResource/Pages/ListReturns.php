<?php

namespace App\Filament\Resources\ReturnsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ReturnsResource;
use App\Filament\Resources\ReturnsResource\Widgets\StatsOverview;

class ListReturns extends ListRecords
{
    protected static string $resource = ReturnsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
