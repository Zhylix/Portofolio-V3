<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General System Information')
                    ->description('Identify the project, system classification, and operational status.')
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
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),
                                TextInput::make('role')
                                    ->placeholder('e.g. Lead Backend Architect'),
                                Select::make('status')
                                    ->options([
                                        ProjectStatus::PLANNING->value => 'Planning',
                                        ProjectStatus::IN_PROGRESS->value => 'In Progress',
                                        ProjectStatus::COMPLETED->value => 'Completed',
                                        ProjectStatus::MAINTAINED->value => 'Active Maintenance',
                                        ProjectStatus::ARCHIVED->value => 'Archived',
                                    ])
                                    ->default(ProjectStatus::COMPLETED->value)
                                    ->required(),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('featured')
                                    ->label('Featured Portfolio Project')
                                    ->inline(false)
                                    ->default(false),
                            ]),
                    ]),

                Section::make('Architectural & Technical Narrative')
                    ->description('Problem statements, implemented solutions, and architecture diagrams.')
                    ->schema([
                        Textarea::make('short_description')
                            ->required()
                            ->rows(3)
                            ->helperText('Concise executive summary of this project.'),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Full technical case study and architecture breakdown.'),
                        Grid::make(2)
                            ->schema([
                                Textarea::make('problem')
                                    ->label('The Engineering Problem')
                                    ->rows(3),
                                Textarea::make('solution')
                                    ->label('The Implemented Solution')
                                    ->rows(3),
                            ]),
                        Textarea::make('architecture')
                            ->label('System Architecture Specification')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Features & Deployment Links')
                    ->description('Feature highlights, source repositories, and live URLs.')
                    ->schema([
                        TagsInput::make('features')
                            ->label('Key Capabilities & Features')
                            ->placeholder('Type feature and press Enter')
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('github_url')
                                    ->label('GitHub Repository URL')
                                    ->url(),
                                TextInput::make('demo_url')
                                    ->label('Live System Demo URL')
                                    ->url(),
                                DatePicker::make('started_at')
                                    ->label('Development Started'),
                                DatePicker::make('ended_at')
                                    ->label('Shipped / Completed'),
                            ]),
                    ]),

                Section::make('Connected Evidence & Relationships')
                    ->description('Associate technologies, competencies, career milestones, and awards.')
                    ->schema([
                        Select::make('technologies')
                            ->relationship('technologies', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('experiences')
                            ->relationship('experiences', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('achievements')
                            ->relationship('achievements', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ]),

                Section::make('Media Gallery')
                    ->description('Project cover artwork and architecture screenshots.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->image()
                            ->imageEditor(),
                        SpatieMediaLibraryFileUpload::make('screenshots')
                            ->collection('screenshots')
                            ->multiple()
                            ->image()
                            ->reorderable(),
                    ]),
            ]);
    }
}
