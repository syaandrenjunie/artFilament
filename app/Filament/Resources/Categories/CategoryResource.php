<?php

namespace App\Filament\Resources\Categories;

use BackedEnum;
use App\Models\Category;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ViewCategory;
use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Filament\Resources\Categories\Schemas\CategoryInfolist;
use App\Filament\Resources\Categories\RelationManagers\ArtworksRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    //control sidebar icon

    protected static ?string $recordTitleAttribute = 'name';
    //control page title / breadcrumb title / modal title

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }
    //form definition

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }
    //infolist definition

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }
    //table listing definition

    public static function getRelations(): array    //relationships
    {
        return [
            ArtworksRelationManager::class,
        ];
    }

    public static function getPages(): array       //pages and routes
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'view' => ViewCategory::route('/{record}'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder    
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    //include soft deleted records  
}
