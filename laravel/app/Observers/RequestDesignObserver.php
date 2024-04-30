<?php

namespace App\Observers;

use App\Models\RequestDesign;
use Filament\Notifications\Notification;

class RequestDesignObserver
{
    /**
     * Handle the RequestDesign "created" event.
     */
    public function created(RequestDesign $requestDesign): void
    {
        Notification::make()
            ->title(title: 'You have a new task: ' . $requestDesign->name)
            ->sendToDatabase($requestDesign->user);
    }

    /**
     * Handle the RequestDesign "updated" event.
     */
    public function updated(RequestDesign $requestDesign): void
    {
        //
    }

    /**
     * Handle the RequestDesign "deleted" event.
     */
    public function deleted(RequestDesign $requestDesign): void
    {
        //
    }

    /**
     * Handle the RequestDesign "restored" event.
     */
    public function restored(RequestDesign $requestDesign): void
    {
        //
    }

    /**
     * Handle the RequestDesign "force deleted" event.
     */
    public function forceDeleted(RequestDesign $requestDesign): void
    {
        //
    }
}
