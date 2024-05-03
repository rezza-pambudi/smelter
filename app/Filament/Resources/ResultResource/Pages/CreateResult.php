<?php

namespace App\Filament\Resources\ResultResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use App\Filament\Resources\ResultResource;
use Filament\Resources\Pages\CreateRecord;

class CreateResult extends CreateRecord
{
    protected static string $resource = ResultResource::class;

    protected function afterSave(): void
    {
    }

    // protected function getRedirectUrl(): string
    // {
    //     $name = Auth::user()->name;
    //     Notification::make()
    //         ->success()
    //         ->title('Request dibuat oleh '.$name)
    //         ->body('Request Telah disimpan')
    //         ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());

    //     // Notification::make()
    //     //     ->success()
    //     //     ->title('Murid ' . $this->name . ' telah mendaftar')
    //     //     ->sendToDatabase(User::whereHas('roles', function ($query) {
    //     //         $query->where('name', 'admin');
    //     //     })->get());

    //     return $this->previousUrl ?? $this->getResource()::getUrl('index');
    // }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Request disimpan')
            ->body('Request ada telah tersimpan')
            ->sendToDatabase(User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get());
    }
}
