<?php

namespace App\Filament\Resources\ReturnsResource\Pages;

use App\Models\Borrowing;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ReturnsResource;

class ViewReturns extends ViewRecord
{
    protected static string $resource = ReturnsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Back')
                ->label('Back')
                ->url($this->getResource()::getUrl('index'))
        ];
    }

    public function mount(string|int $record): void
    {
        parent::mount($record);

        $borrowing = Borrowing::with('book', 'member')->find($this->record->borrowing_id);

        if ($borrowing) {
            $this->form->fill([
                'borrowing_id' => $borrowing->id,
                'book_title' => $borrowing->book->title,
                'member_name' => $borrowing->member->name,
                'date_loan' => $borrowing->date_loan,
                'date_due' => $borrowing->date_due,
                'status' => $borrowing->status,
                'date_return' => $this->record->date_return,
                'charge' => $this->record->charge,
            ]);
        }
    }



}
