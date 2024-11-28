<?php

namespace App\Filament\Resources\BorrowingResource\Pages;

use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BorrowingResource;
use App\Notifications\BorrowingCreatedNotification;

class CreateBorrowing extends CreateRecord
{
    protected static string $resource = BorrowingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
