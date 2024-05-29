<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Information extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.information';

    protected static ?string $navigationGroup = 'Informations';

    protected static ?string $title = 'Jadwal piket';

    public function getTitle(): string|Htmlable
    {
        return false;
    }
}
