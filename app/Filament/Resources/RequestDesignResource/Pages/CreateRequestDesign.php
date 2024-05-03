<?php

namespace App\Filament\Resources\RequestDesignResource\Pages;

use App\Models\User;
use Filament\Pages\Actions;
use Filament\Actions\Action;
use App\Models\RequestDesign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use App\Filament\Resources\ResultResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Console\View\Components\Alert;
use App\Filament\Resources\RequestDesignResource;
use Illuminate\Notifications\Notifiable;


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
        $name = Auth::user()->name;
        Notification::make()
            ->success()
            ->title('Request dibuat oleh '.$name)
            ->body('Request Telah disimpan')
            ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());

        // Notification::make()
        //     ->success()
        //     ->title('Murid ' . $this->name . ' telah mendaftar')
        //     ->sendToDatabase(User::whereHas('roles', function ($query) {
        //         $query->where('name', 'admin');
        //     })->get());

        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
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
