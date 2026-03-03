<?php

namespace App\Filament\Resources\Penulis;

use App\Filament\Resources\Penulis\Pages\CreatePenulis;
use App\Filament\Resources\Penulis\Pages\EditPenulis;
use App\Filament\Resources\Penulis\Pages\ListPenulis;
use App\Filament\Resources\Penulis\Schemas\PenulisForm;
use App\Filament\Resources\Penulis\Tables\PenulisTable;
use App\Models\Penulis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenulisResource extends Resource
{
    protected static ?string $model = Penulis::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationLabel = 'Kelola Penulis';

    public static function form(Schema $schema): Schema
    {
        return PenulisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenulisTable::configure($table);
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
            'index' => ListPenulis::route('/'),
            'create' => CreatePenulis::route('/create'),
            'edit' => EditPenulis::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
