<?php

namespace App\Filament\Resources\Artists\Tables;

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

class ArtistsTable
{
    public static function configure(Table $table): Table       //take this empty table, decorate it and return it back
    {
        return $table
            ->columns([                     //defines what data is visible
                TextColumn::make('name')          //plain text
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->icon(Heroicon::Envelope)
                    ->iconColor('primary')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contact')
                    ->searchable(),
                ImageColumn::make('picture')      //image returns real image instead of URL
                    ->disk('local')
                    ->circular(),
                TextColumn::make('created_at')
                    ->dateTime()                        //formats timestamp
                    ->sortable()                        //allows sorting by this column
                    ->toggleable(isToggledHiddenByDefault: true),   //can be hidden/shown by user. by default hidden
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([                 //require softdeletes
                TrashedFilter::make(),           //filter to show trashed, non-trashed, or all records
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([          //require softdeletes
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
