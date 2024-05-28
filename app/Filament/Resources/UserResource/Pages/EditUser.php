<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $name = Auth::user()->name;
        Notification::make()
            ->success()
            ->title('User telah diedit oleh '.$name)
            ->body('Perubahan berhasil')
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
