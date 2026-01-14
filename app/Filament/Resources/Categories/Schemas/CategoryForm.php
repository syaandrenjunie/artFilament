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
                Fieldset::make('Category Information')
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'xl' => 3,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        Textarea::make('description')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}

