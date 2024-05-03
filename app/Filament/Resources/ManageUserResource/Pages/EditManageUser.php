<?php

namespace App\Filament\Resources\ManageUserResource\Pages;

use App\Filament\Resources\ManageUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageUser extends EditRecord
{
    protected static string $resource = ManageUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
