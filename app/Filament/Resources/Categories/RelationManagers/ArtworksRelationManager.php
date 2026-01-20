<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use App\Filament\Resources\Artworks\ArtworkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ArtworksRelationManager extends RelationManager
{
    protected static string $relationship = 'artworks'; 
    //name of the relationship method in Category model

    protected static ?string $relatedResource = ArtworkResource::class;
    //reuse whatever is defined in ArtworkResource - table / form / infolist
    //when enabled YES to linking

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),   //trgigger the ArtworkResource form
            ]);
    }
}
