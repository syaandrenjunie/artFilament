<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\Customer;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class CustomerInfolist
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
                        
                    ]),

                Fieldset::make('Contact Info')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('email')->label('Email address')->copyable()->copyMessage('Email address copied to clipboard!'),
                        TextEntry::make('contact')->placeholder('-'),
                    ]),

                Fieldset::make('Media & Timestamps')
                    ->columns(3)
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('profile_picture')
                            ->collection('profile_picture')
                            ->placeholder('-'),
                        TextEntry::make('created_at')->dateTime()->placeholder('-'),
                        TextEntry::make('updated_at')->dateTime()->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn (Customer $record): bool => $record->trashed()),
                    ]),
            ]);
    }
}
