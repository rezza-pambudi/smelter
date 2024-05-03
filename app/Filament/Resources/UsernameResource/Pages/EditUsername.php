<?php

namespace App\Filament\Resources\UsernameResource\Pages;

use App\Filament\Resources\UsernameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsername extends EditRecord
{
    protected static string $resource = UsernameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
