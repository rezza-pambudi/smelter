<?php

namespace App\Filament\Resources\DatauserResource\Pages;

use App\Filament\Resources\DatauserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatauser extends EditRecord
{
    protected static string $resource = DatauserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
