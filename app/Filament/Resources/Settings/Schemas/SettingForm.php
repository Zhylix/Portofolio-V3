<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('System Configuration')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('key')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('type')
                                    ->options([
                                        'string' => 'String / Text',
                                        'boolean' => 'Boolean Flag',
                                        'integer' => 'Integer Number',
                                        'json' => 'JSON Array',
                                    ])
                                    ->default('string'),
                            ]),
                        Textarea::make('value')
                            ->rows(4),
                    ]),
            ]);
    }
}
