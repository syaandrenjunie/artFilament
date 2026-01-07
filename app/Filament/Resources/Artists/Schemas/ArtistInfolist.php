<?php

namespace App\Filament\Resources\Artists\Schemas;

use App\Models\Artist;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArtistInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('bio')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('contact')
                    ->placeholder('-'),
                TextEntry::make('picture')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Artist $record): bool => $record->trashed()),
            ]);
    }
}
