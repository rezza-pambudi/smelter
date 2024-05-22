<?php

namespace App\Filament\Resources\RequestDesignResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\RequestDesignResource;

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
