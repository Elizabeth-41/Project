<?php

namespace App\Filament\Resources\BookingTransactionResource\Pages;

use App\Filament\Resources\BookingTransactionResource;
use App\Models\WorkshopParticipant;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditBookingTransaction extends EditRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Fetch existing participants and add them to the form data
        $data['participants'] = $this->record->participants->map(function ($participant) {
            return [
                'name' => $participant->name,
                'occupation' => $participant->occupation,
                'email' => $participant->email,
            ];
        })->toArray();

        return $data;
    }

    protected function afterSave(): void
    {
        DB::transaction(function () {
            $record = $this->record;

            // Clear existing participants to avoid duplication
            $record->participants()->delete();

            // Get participants from the form state
            $participants = $this->form->getState()['participants'] ?? [];

            // Check if participants array is not empty
            if (!empty($participants)) {
                foreach ($participants as $participant) {
                    try {
                        WorkshopParticipant::create([
                            'workshop_id' => $record->workshop_id,
                            'booking_transaction_id' => $record->id,
                            'name' => $participant['name'],
                            'occupation' => $participant['occupation'],
                            'email' => $participant['email'],
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Failed to create workshop participant: ' . $e->getMessage());
                    }
                }
            }
        });
    }
}
