<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Skill Classification')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('skill_category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('icon')
                                    ->placeholder('e.g. devicon or heroicon name'),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('featured')
                                    ->label('Featured Core Skill')
                                    ->inline(false)
                                    ->default(false),
                            ]),
                        Textarea::make('description')
                            ->rows(3),
                    ]),

                Section::make('Empirical Evidence Links')
                    ->description('Demonstrate capability through linked projects, experiences, and certifications.')
                    ->schema([
                        Select::make('projects')
                            ->relationship('projects', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('experiences')
                            ->relationship('experiences', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('certificates')
                            ->relationship('certificates', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('achievements')
                            ->relationship('achievements', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }
}
