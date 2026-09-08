<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Achievement Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('organization')
                                    ->placeholder('Awarding body or event organizer'),
                                DatePicker::make('date'),
                                TextInput::make('rank')
                                    ->placeholder('e.g. 1st Place, Finalist, Gold Medal'),
                                TextInput::make('result')
                                    ->placeholder('e.g. Trophy & Cash Prize'),
                                TextInput::make('url')
                                    ->url()
                                    ->columnSpanFull(),
                                Toggle::make('featured')
                                    ->default(false),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                        Textarea::make('description')
                            ->rows(3),
                    ]),

                Section::make('Media & Associated Milestones')
                    ->schema([
                        Select::make('skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
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
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->image(),
                    ]),
            ]);
    }
}
