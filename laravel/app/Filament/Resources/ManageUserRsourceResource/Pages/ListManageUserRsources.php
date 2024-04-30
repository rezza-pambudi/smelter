<?php

namespace App\Filament\Resources\ManageUserRsourceResource\Pages;

use App\Filament\Resources\ManageUserRsourceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageUserRsources extends ListRecords
{
    protected static string $resource = ManageUserRsourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
