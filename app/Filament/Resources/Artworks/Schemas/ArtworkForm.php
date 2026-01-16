<?php

namespace App\Filament\Resources\Artworks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ArtworkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('price')
                    ->prefix('MYR ')
                    ->required(),
                 Select::make('artist_id')
                    ->relationship('artist', 'name')
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                    ])
                    ->required(),
                // Select::make('artist_id')
                //     ->label('Artist')
                //     ->relationship('artist', 'name')
                //     ->searchable()
                //     ->preload()
                //     ->required(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                FileUpload::make('picture'),

            ]);
    }
}
