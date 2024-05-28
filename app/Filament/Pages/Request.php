<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Request extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static string $view = 'filament.pages.request';

    // protected static ?string $title = 'false';

    public function getTitle(): string|Htmlable
    {
        return false;
    }
}
