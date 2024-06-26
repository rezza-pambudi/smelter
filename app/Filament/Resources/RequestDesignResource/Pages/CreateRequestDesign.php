<?php

namespace App\Filament\Resources\RequestDesignResource\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\RequestDesignResource;
use App\Notifications\CreateRequestNotifications;
// use App\Models\Result;

class CreateRequestDesign extends CreateRecord
{
    protected static string $resource = RequestDesignResource::class;

    // protected function afterSave(): void
    // {
    //     $request_design = $this->record;

    //     Notification::make()
    //         ->title('New Brand Created')
    //         ->icon('heroicon-o-shopping-bag')
    //         ->body("**New Brand {$request_design->name} created!**")
    //         ->actions([
    //             Action::make('View')->url(
    //                 RequestDesignResource::getUrl('edit',['record'=>$request_design])
    //             ),
    //         ])
    //         ->sendToDatabase(auth()->user());
    // }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {

        $result = $this->record;

        Notification::make()
            ->title("{$result->result?->tipe}")
            ->icon('heroicon-o-megaphone')
            ->body("From: {$result->result?->email}<br>Brand: {$result->result?->brand}")
            ->persistent()
            ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());

         $user=Auth::user();
         $message='record created';
         $user->notify(new CreateRequestNotifications($message));

         
        //$data = ['message' => 'This is a test!'];
        //Mail::to('smelter@detiknetwork-salesproduct.com')->send(new CreateRequest($data));
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Request telah dibuat')
            ->body('Pantau request di menu all request');
    }

    use Notifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address only...
        return $this->email;

        // Return email address and name...
        return [$this->email => $this->name];

        //return $this->users()->pluck('name','email');
    }

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
