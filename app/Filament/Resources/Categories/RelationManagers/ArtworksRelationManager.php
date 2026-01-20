<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use App\Filament\Resources\Artworks\ArtworkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ArtworksRelationManager extends RelationManager
{
    protected static string $relationship = 'artworks';

    protected static ?string $relatedResource = ArtworkResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
