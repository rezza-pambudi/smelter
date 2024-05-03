<?php

namespace App\Filament\Resources\DatauserResource\Pages;

use App\Filament\Resources\DatauserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatausers extends ListRecords
{
    protected static string $resource = DatauserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
