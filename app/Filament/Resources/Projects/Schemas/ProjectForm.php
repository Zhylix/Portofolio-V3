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
                Section::make('General Information')
                    ->description('Informasi utama project, kategori, dan status publikasi.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('Judul yang akan tampil pada project card.')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Slug unik untuk URL project di public portfolio.'),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->nullable()
                                    ->helperText('Kategori bidang atau industri project.'),
                                TextInput::make('role')
                                    ->label('Role')
                                    ->placeholder('e.g. Lead Backend Architect')
                                    ->helperText('Peran kamu dalam pengembangan project ini.'),
                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        ProjectStatus::PLANNING->value => 'Planning',
                                        ProjectStatus::IN_PROGRESS->value => 'In Progress',
                                        ProjectStatus::COMPLETED->value => 'Completed',
                                        ProjectStatus::MAINTAINED->value => 'Active Maintenance',
                                        ProjectStatus::ARCHIVED->value => 'Archived',
                                    ])
                                    ->default(ProjectStatus::COMPLETED->value)
                                    ->required()
                                    ->helperText('Status kesiapan atau deployment project.'),
                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Urutan prioritas penampilan card.'),
                                Toggle::make('featured')
                                    ->label('Featured')
                                    ->inline(false)
                                    ->default(false)
                                    ->helperText('Centang jika ingin project ini tampil di section featured.'),
                            ]),
                    ]),

                Section::make('Architectural & Technical Narrative')
                    ->description('Problem statement, solusi implementasi, dan arsitektur sistem.')
                    ->schema([
                        Textarea::make('short_description')
                            ->label('Short Description')
                            ->required()
                            ->rows(3)
                            ->helperText('Gunakan deskripsi singkat untuk preview di halaman Projects.'),
                        RichEditor::make('description')
                            ->label('Description')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Full technical case study dan breakdown arsitektur project.'),
                        Grid::make(2)
                            ->schema([
                                Textarea::make('problem')
                                    ->label('The Engineering Problem')
                                    ->rows(3)
                                    ->helperText('Tantangan atau masalah teknis yang dihadapi.'),
                                Textarea::make('solution')
                                    ->label('The Implemented Solution')
                                    ->rows(3)
                                    ->helperText('Solusi arsitektur dan rekayasa yang kamu implementasikan.'),
                            ]),
                        Textarea::make('architecture')
                            ->label('System Architecture Specification')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Deskripsi arsitektur sistem, database, atau pipeline backend.'),
                    ]),

                Section::make('Features & Deployment Links')
                    ->description('Fitur utama, repository GitHub, dan live demo.')
                    ->schema([
                        TagsInput::make('features')
                            ->label('Key Features')
                            ->placeholder('Ketik fitur lalu tekan Enter')
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('github_url')
                                    ->label('GitHub Repository URL')
                                    ->url()
                                    ->helperText('URL repository kode sumber di GitHub.'),
                                TextInput::make('demo_url')
                                    ->label('Live System Demo URL')
                                    ->url()
                                    ->helperText('URL deployment publik atau interactive demo.'),
                                DatePicker::make('started_at')
                                    ->label('Development Started'),
                                DatePicker::make('ended_at')
                                    ->label('Shipped / Completed'),
                            ]),
                    ]),

                Section::make('Stack & Relationships')
                    ->description('Hubungkan project dengan technologies, skills, dan pencapaian terkait.')
                    ->schema([
                        Select::make('technologies')
                            ->label('Technologies')
                            ->relationship('technologies', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->helperText('Pilih technology yang digunakan pada project ini.'),
                        Select::make('skills')
                            ->label('Skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->helperText('Pilih technical skills yang relevan dengan project.'),
                        Select::make('experiences')
                            ->label('Experiences')
                            ->relationship('experiences', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('achievements')
                            ->label('Achievements')
                            ->relationship('achievements', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ]),

                Section::make('Media Gallery')
                    ->description('Cover image dan screenshot tampilan project.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Cover Image')
                            ->collection('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Cover image utama beresolusi tinggi (format JPG, PNG, atau WebP).'),
                        SpatieMediaLibraryFileUpload::make('screenshots')
                            ->label('Gallery Screenshots')
                            ->collection('screenshots')
                            ->multiple()
                            ->image()
                            ->reorderable()
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload screenshot pendukung antarmuka atau arsitektur sistem.'),
                    ]),
            ]);
    }
}
