<?php

namespace App\Filament\Resources\SimpleProducts;

use App\Filament\Resources\SimpleProducts\Pages\CreateSimpleProduct;
use App\Filament\Resources\SimpleProducts\Pages\EditSimpleProduct;
use App\Filament\Resources\SimpleProducts\Pages\ListSimpleProducts;
use App\Filament\Resources\SimpleProducts\Schemas\SimpleProductForm;
use App\Filament\Resources\SimpleProducts\Tables\SimpleProductsTable;
use App\Models\SimpleProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SimpleProductResource extends Resource
{
    protected static ?string $model = SimpleProduct::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Sản phẩm';

    protected static ?string $pluralModelLabel = 'Sản phẩm';

    protected static ?string $modelLabel = 'Sản phẩm';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return SimpleProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SimpleProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSimpleProducts::route('/'),
            'create' => CreateSimpleProduct::route('/create'),
            'edit' => EditSimpleProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
}
