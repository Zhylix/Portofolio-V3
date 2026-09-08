<?php

namespace App\Filament\Resources\Technologies;

use App\Filament\Resources\Technologies\Pages\CreateTechnology;
use App\Filament\Resources\Technologies\Pages\EditTechnology;
use App\Filament\Resources\Technologies\Pages\ListTechnologies;
use App\Filament\Resources\Technologies\Schemas\TechnologyForm;
use App\Filament\Resources\Technologies\Tables\TechnologiesTable;
use App\Models\Technology;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TechnologyResource extends Resource
{
    protected static ?string $model = Technology::class;

    protected static string|UnitEnum|null $navigationGroup = 'WORK';

    protected static ?string $navigationLabel = 'Technologies';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCommandLine;

    public static function form(Schema $schema): Schema
    {
        return TechnologyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TechnologiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTechnologies::route('/'),
            'create' => CreateTechnology::route('/create'),
            'edit' => EditTechnology::route('/{record}/edit'),
        ];
    }
}
