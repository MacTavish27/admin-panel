<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('url')->required(),
            TextInput::make('order')->numeric(),

        ]);
    }
}
