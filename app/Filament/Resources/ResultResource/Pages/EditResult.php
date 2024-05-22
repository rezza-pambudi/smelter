<?php

namespace App\Filament\Resources\ResultResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ResultResource;

class EditResult extends EditRecord
{
    protected static string $resource = ResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $name = Auth::user()->name;
        $result = $this->record;

        Notification::make()
            ->success()
            ->title('INFO: PROGRESS REQUEST oleh ' . $name)
            ->body("Request dari: {$result->email}, Brand: {$result->brand}, Status: {$result->status} 
            ")
            ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());

        // Notification::make()
        //     ->success()
        //     ->title('Murid ' . $this->name . ' telah mendaftar')
        //     ->sendToDatabase(User::whereHas('roles', function ($query) {
        //         $query->where('name', 'admin');
        //     })->get());

        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
