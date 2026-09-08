<?php

namespace App\Filament\Resources\SkillCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SkillCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Skill Category Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('icon')
                                    ->placeholder('e.g. server-stack, cpu-chip'),
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
