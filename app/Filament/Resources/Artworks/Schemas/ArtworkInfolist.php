<?php

namespace App\Filament\Resources\Artworks\Schemas;

use App\Models\Artwork;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;


class ArtworkInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->aside()
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('picture')
                            ->collection('art_picture')
                            ->square()
                            ->size(260)
                            ->placeholder('No image'),
                    ]),

                Section::make('Artwork Details')
                    ->schema([
                        TextEntry::make('title')
                            ->size(TextSize::Large)
                            ->weight('bold'),

                        TextEntry::make('price')
                            ->money('MYR'),

                        TextEntry::make('artist.name')
                            ->label('Artist'),

                        TextEntry::make('category.name')
                            ->label('Category'),

                        TextEntry::make('created_at')
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ]),
            ]);
    }
}
