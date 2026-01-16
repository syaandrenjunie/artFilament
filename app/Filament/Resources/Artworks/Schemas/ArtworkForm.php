<?php

namespace App\Filament\Resources\Artworks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ArtworkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('price')
                    ->required(),
                TextInput::make('picture'),
                TextInput::make('artist_id')
                    ->required()
                    ->numeric(),
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
