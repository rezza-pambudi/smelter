<?php

namespace App\Filament\Guest\Resources\RequestDesignResource\Pages;

use App\Filament\Guest\Resources\RequestDesignResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestDesign extends EditRecord
{
    protected static string $resource = RequestDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
