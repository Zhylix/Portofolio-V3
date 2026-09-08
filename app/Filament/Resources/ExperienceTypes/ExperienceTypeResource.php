<?php

namespace App\Filament\Resources\ExperienceTypes;

use App\Filament\Resources\ExperienceTypes\Pages\CreateExperienceType;
use App\Filament\Resources\ExperienceTypes\Pages\EditExperienceType;
use App\Filament\Resources\ExperienceTypes\Pages\ListExperienceTypes;
use App\Filament\Resources\ExperienceTypes\Schemas\ExperienceTypeForm;
use App\Filament\Resources\ExperienceTypes\Tables\ExperienceTypesTable;
use App\Models\ExperienceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ExperienceTypeResource extends Resource
{
    protected static ?string $model = ExperienceType::class;

    protected static string|UnitEnum|null $navigationGroup = 'MY JOURNEY';

    protected static ?string $navigationLabel = 'Experience Types';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    public static function form(Schema $schema): Schema
    {
        return ExperienceTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExperienceTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExperienceTypes::route('/'),
            'create' => CreateExperienceType::route('/create'),
            'edit' => EditExperienceType::route('/{record}/edit'),
        ];
    }
}
