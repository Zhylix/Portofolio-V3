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
                    ->description('Kelola kompetisi, penghargaan, dan awards yang telah kamu raih.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->helperText('Nama kompetisi atau penghargaan yang diraih.')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Slug unik untuk identifikasi achievement.'),
                                TextInput::make('organization')
                                    ->label('Organization / Host')
                                    ->placeholder('Lembaga penyelenggara atau institusi')
                                    ->helperText('Institusi atau penyelenggara kompetisi.'),
                                DatePicker::make('date')
                                    ->label('Award Date'),
                                TextInput::make('rank')
                                    ->label('Rank / Placement')
                                    ->placeholder('e.g. 1st Place, Finalist, Gold Medal')
                                    ->helperText('Posisi juara atau peringkat yang didapatkan.'),
                                TextInput::make('result')
                                    ->label('Prize / Result')
                                    ->placeholder('e.g. Trophy & Grant')
                                    ->helperText('Hadiah atau apresiasi yang diterima.'),
                                TextInput::make('url')
                                    ->label('Official Verification URL')
                                    ->url()
                                    ->columnSpanFull()
                                    ->helperText('Tautan pengumuman atau publikasi resmi acara.'),
                                Toggle::make('featured')
                                    ->label('Featured')
                                    ->default(false)
                                    ->helperText('Tampilkan di highlight pencapaian utama portfolio.'),
                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Urutan prioritas penampilan.'),
                            ]),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->helperText('Penjelasan singkat tentang karya, proyek, atau inovasi yang dilombakan.'),
                    ]),

                Section::make('Associated Evidence & Media')
                    ->description('Hubungkan dengan skills, project, dan foto dokumentasi penghargaan.')
                    ->schema([
                        Select::make('skills')
                            ->label('Skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('projects')
                            ->label('Projects')
                            ->relationship('projects', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('experiences')
                            ->label('Experiences')
                            ->relationship('experiences', 'title')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Award Photo / Certificate')
                            ->collection('image')
                            ->image()
                            ->maxSize(10240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload foto piala, piagam juara, atau momen penyerahan penghargaan.'),
                    ]),
            ]);
    }
}
