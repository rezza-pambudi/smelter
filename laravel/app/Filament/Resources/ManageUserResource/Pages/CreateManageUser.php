<?php

namespace App\Filament\Resources\ManageUserResource\Pages;

use App\Filament\Resources\ManageUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManageUser extends CreateRecord
{
    protected static string $resource = ManageUserResource::class;
}
