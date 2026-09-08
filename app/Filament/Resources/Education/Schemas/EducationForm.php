<?php

namespace App\Filament\Resources\Education\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Academic Credentials')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('institution')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('degree')
                                    ->placeholder("e.g. Bachelor's Degree"),
                                TextInput::make('major')
                                    ->placeholder('e.g. Computer Science'),
                                DatePicker::make('started_at'),
                                DatePicker::make('ended_at'),
                                Toggle::make('is_current')
                                    ->label('Ongoing Program')
                                    ->default(false),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                        Textarea::make('description')
                            ->rows(3),
                    ]),
            ]);
    }
}
