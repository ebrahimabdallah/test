<?php

namespace App\Filament\Resources\Works;

use App\Filament\Resources\Works\Pages\CreateWorks;
use App\Filament\Resources\Works\Pages\EditWorks;
use App\Filament\Resources\Works\Pages\ListWorks;
use App\Filament\Resources\Works\Pages\ViewWorks;
use App\Filament\Resources\Works\Schemas\WorksForm;
use App\Filament\Resources\Works\Schemas\WorksInfolist;
use App\Filament\Resources\Works\Tables\WorksTable;
use App\Models\Works;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WorksResource extends Resource
{
    protected static ?string $model = Works::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WorksForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorksInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorksTable::configure($table);
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
            'index' => ListWorks::route('/'),
            'create' => CreateWorks::route('/create'),
            'view' => ViewWorks::route('/{record}'),
            'edit' => EditWorks::route('/{record}/edit'),
        ];
    }
}
