<?php

namespace App\Filament\Resources\RequestDesignResource\Pages;

use App\Filament\Resources\RequestDesignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Closure;

class ListRequestDesigns extends ListRecords
{
    protected static string $resource = RequestDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableRecordActionUsing(): ?Closure
    {
        return null;
    }

    /**
 * Get the mail representation of the notification.
 */

}
