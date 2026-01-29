<?php

namespace App\Filament\Artist\Resources\Artworks\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ArtworksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('picture')
                    ->collection('art_picture')
                    ->square(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('MYR')
                    ->searchable(),
                TextColumn::make('artist.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn($livewire) => auth()->user()->hasRole('admin')), // only admin sees it
                    ForceDeleteBulkAction::make()
                        ->visible(fn($livewire) => auth()->user()->hasRole('admin')),
                    RestoreBulkAction::make()
                        ->visible(fn($livewire) => auth()->user()->hasRole('admin')),
                ]),
            ]);
    }
}
