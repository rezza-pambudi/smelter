<?php

namespace App\Filament\Resources\UsernameResource\Pages;

use App\Filament\Resources\UsernameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsernames extends ListRecords
{
    protected static string $resource = UsernameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
