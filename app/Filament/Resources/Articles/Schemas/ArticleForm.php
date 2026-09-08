<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Enums\ContentStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article Publishing Details')
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
                                TextInput::make('category')
                                    ->placeholder('e.g. System Architecture, Databases'),
                                Select::make('status')
                                    ->options([
                                        ContentStatus::DRAFT->value => 'Draft',
                                        ContentStatus::PUBLISHED->value => 'Published',
                                        ContentStatus::ARCHIVED->value => 'Archived',
                                    ])
                                    ->default(ContentStatus::DRAFT->value)
                                    ->required(),
                                DateTimePicker::make('published_at')
                                    ->default(now()),
                                SpatieMediaLibraryFileUpload::make('thumbnail')
                                    ->collection('thumbnail')
                                    ->image(),
                            ]),
                    ]),

                Section::make('Writing & Content Canvas')
                    ->description('Comfortable rich content writing environment.')
                    ->schema([
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->helperText('Short overview summary displayed on list pages.'),
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('articles/attachments'),
                    ]),

                Section::make('Related Systems & Skills')
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
                    ]),
            ]);
    }
}
