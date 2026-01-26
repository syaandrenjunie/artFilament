<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('contact'),
                SpatieMediaLibraryFileUpload::make('profile_picture')
                    ->collection('profile_picture')
                    ->image()
        
                    ->nullable(),
                    
            ]);
    }
}
