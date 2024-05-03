<?php

namespace App\Filament\Resources\RequestDesignResource\Pages;

use App\Filament\Resources\RequestDesignResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestDesign extends EditRecord
{
    protected static string $resource = RequestDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
