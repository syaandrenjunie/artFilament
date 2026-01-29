<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
    ->components([
        TextInput::make('name')->required(),
        Textarea::make('description')->placeholder('Provide a brief description of the category.'),
    ]);

    }
}

