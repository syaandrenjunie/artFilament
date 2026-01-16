<?php

namespace App\Filament\Resources\Artworks\Schemas;

use App\Models\Artwork;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArtworkInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('price'),
                TextEntry::make('picture')
                    ->placeholder('-'),
                TextEntry::make('artist_id')
                    ->numeric(),
                TextEntry::make('category_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Artwork $record): bool => $record->trashed()),
            ]);
    }
}
