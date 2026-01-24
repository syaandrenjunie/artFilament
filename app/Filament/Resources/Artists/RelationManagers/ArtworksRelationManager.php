<?php

namespace App\Filament\Resources\Artists\RelationManagers;

use App\Models\Artwork;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Support\Enums\TextSize;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ArtworksRelationManager extends RelationManager
{
    protected static string $relationship = 'artworks';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('picture')
                    ->image()
                    ->disk('public')
                    ->helperText('Recommended size: square image, max 3MB.')
                    ->imagePreviewHeight('250'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('MYR ')
                    ->minValue(0)
                    ->helperText('Enter the price in Malaysian Ringgit')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->preload()
                    ->required()
                    ->helperText('Every artwork must belong to a category'),

            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->aside()
                    ->schema([
                        ImageEntry::make('picture')
                            ->disk('local')
                            ->square()
                            ->size(260)
                            ->placeholder('No image'),
                    ]),

                Section::make('Artwork Details')
                    ->schema([
                        TextEntry::make('title')
                            ->size(TextSize::Large)
                            ->weight('bold'),

                        TextEntry::make('price')
                            ->money('MYR'),

                        TextEntry::make('artist.name')
                            ->label('Artist'),

                        TextEntry::make('category.name')
                            ->label('Category'),

                        TextEntry::make('created_at')
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ]),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('MYR')
                    ->searchable(),
                ImageColumn::make('picture')
                    ->square()
                    ->disk('local'),
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
            ->emptyStateHeading('No Artworks Found')
            ->emptyStateDescription('Create artworks to display them here.')    
            ->emptyStateActions([
                CreateAction::make()
                    ->icon('heroicon-o-plus')
                    ->label('Create Artwork'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->visible(fn (Table $table) => $table->getRecords()->isNotEmpty()),
                // AssociateAction::make(),    when have relationship
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                // DissociateAction::make(),   when have relationship
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
