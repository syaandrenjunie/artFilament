<?php

namespace App\Filament\Resources\Artworks\Schemas;

use App\Models\Artwork;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class ArtworkInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

            ImageEntry::make('picture')
                            ->square()
                            ->size(200)
                            ->placeholder('-'),

                Fieldset::make('Basic Info')
                    ->columns([
                        'default' => 2,
                        'md' => 2,
                        'xl' => 2,
                    ])
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('price')
                            ->money('MYR'),

                        TextEntry::make('artist.name')
                            ->label('Artist'),
                        TextEntry::make('category.name')
                            ->label('Category'),
                        

                    ]),

                Fieldset::make('Media & Timestamps')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(Artwork $record): bool => $record->trashed()),
                    ]),



            ]);
    }
}
