<?php

namespace App\Filament\Resources\Experiences\Schemas;

use App\Enums\ContentStatus;
use App\Enums\VisibilityStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Role & Organization')
                    ->description('Identify the experience, role, and organization.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('role')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('experience_type_id')
                                    ->relationship('experienceType', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Select::make('organization_id')
                                    ->relationship('organization', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),
                                TextInput::make('location')
                                    ->placeholder('e.g. Jakarta, Indonesia or Remote'),
                            ]),
                    ]),

                Section::make('Timeline & Visibility')
                    ->description('Duration, lifecycle status, and priority.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('started_at')
                                    ->label('Start Date'),
                                DatePicker::make('ended_at')
                                    ->label('End Date'),
                                Toggle::make('is_current')
                                    ->label('Currently Active / Ongoing')
                                    ->inline(false)
                                    ->default(false),
                            ]),
                        Grid::make(4)
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        ContentStatus::DRAFT->value => 'Draft',
                                        ContentStatus::PUBLISHED->value => 'Published',
                                        ContentStatus::ARCHIVED->value => 'Archived',
                                    ])
                                    ->default(ContentStatus::PUBLISHED->value)
                                    ->required(),
                                Select::make('visibility')
                                    ->options([
                                        VisibilityStatus::PUBLIC->value => 'Public',
                                        VisibilityStatus::UNLISTED->value => 'Unlisted',
                                        VisibilityStatus::PRIVATE->value => 'Private',
                                    ])
                                    ->default(VisibilityStatus::PUBLIC->value)
                                    ->required(),
                                Toggle::make('featured')
                                    ->label('Featured Highlight')
                                    ->inline(false)
                                    ->default(false),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),

                Section::make('Narrative & Engineering Deep-Dive')
                    ->description('Summary, deep technical narrative, challenges and outcomes.')
                    ->schema([
                        Textarea::make('summary')
                            ->required()
                            ->rows(3)
                            ->helperText('Concise overview of this experience.'),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Detailed case study or full narrative of accomplishments.'),
                        Grid::make(2)
                            ->schema([
                                Textarea::make('contribution')
                                    ->label('Key Contribution')
                                    ->rows(3),
                                Textarea::make('outcome')
                                    ->label('Measurable Outcome / Impact')
                                    ->rows(3),
                                Textarea::make('challenge')
                                    ->label('Technical Challenge')
                                    ->rows(3),
                                Textarea::make('solution')
                                    ->label('Implemented Solution')
                                    ->rows(3),
                            ]),
                    ]),

                Section::make('Connected Evidence & Relationships')
                    ->description('Link this experience to shipped projects, verified skills, credentials, and events.')
                    ->schema([
                        Select::make('projects')
                            ->relationship('projects', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('achievements')
                            ->relationship('achievements', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('certificates')
                            ->relationship('certificates', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('events')
                            ->relationship('events', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ]),
            ]);
    }
}
