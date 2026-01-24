<?php

namespace App\Filament\Resources\Artists\Schemas;

use App\Models\Artist;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class ArtistInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Basic Info')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('bio')->placeholder('-')->columnSpanFull(),
                    ]),

                Fieldset::make('Contact Info')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('email')->label('Email address'),
                        TextEntry::make('contact')->placeholder('-'),
                    ]),

                Fieldset::make('Media & Timestamps')
                    ->columns(3)
                    ->schema([
                        ImageEntry::make('picture')->placeholder('-')->disk('local'),
                        TextEntry::make('created_at')->dateTime()->placeholder('-'),
                        TextEntry::make('updated_at')->dateTime()->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn (Artist $record): bool => $record->trashed()),
                    ]),
            ]);
    }
}
