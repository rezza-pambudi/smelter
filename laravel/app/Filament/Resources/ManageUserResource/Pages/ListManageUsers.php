<?php

namespace App\Filament\Resources\ManageUserResource\Pages;

use App\Filament\Resources\ManageUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageUsers extends ListRecords
{
    protected static string $resource = ManageUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
