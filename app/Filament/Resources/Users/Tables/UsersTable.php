<?php

namespace App\Filament\Resources\Users\Tables;

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

class UsersTable
{
    public static function configure(Table $table): Table
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
                ImageColumn::make('profile_picture')      //image returns real image instead of URL
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
