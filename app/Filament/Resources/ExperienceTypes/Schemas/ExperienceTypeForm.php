<?php

namespace App\Filament\Resources\ExperienceTypes\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExperienceTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Experience Type Details')
                    ->description('Define classification of journey experiences and public visibility.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('code')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('icon')
                                    ->placeholder('e.g. briefcase, academic-cap'),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('Visible on Public Timeline')
                                    ->helperText('When disabled, experiences of this type will be hidden from the public journey.')
                                    ->default(true),
                            ]),
                        Textarea::make('description')
                            ->rows(3),
                    ]),
            ]);
    }
}
