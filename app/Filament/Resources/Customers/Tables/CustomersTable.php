<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([                     
                TextColumn::make('name')          
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->icon(Heroicon::Envelope)
                    ->iconColor('primary')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contact')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('profile_picture')      
                    ->collection('profile_picture')
                    ->circular(),
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
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
