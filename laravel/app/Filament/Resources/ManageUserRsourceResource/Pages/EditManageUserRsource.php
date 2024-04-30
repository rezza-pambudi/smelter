<?php

namespace App\Filament\Resources\ManageUserRsourceResource\Pages;

use App\Filament\Resources\ManageUserRsourceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageUserRsource extends EditRecord
{
    protected static string $resource = ManageUserRsourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
