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
                Section::make('Skill Information')
                    ->description('Kategori keahlian teknis dan konfigurasi penampilan card.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('skill_category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->helperText('Kategori domain keahlian (misal: Backend, Cloud & DevOps).'),
                                TextInput::make('name')
                                    ->label('Skill Name')
                                    ->required()
                                    ->helperText('Nama teknologi atau keahlian teknis.')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->helperText('Slug unik untuk identifikasi skill.'),
                                TextInput::make('icon')
                                    ->label('Icon Identifier')
                                    ->placeholder('e.g. devicon-laravel-plain')
                                    ->helperText('Nama class Devicon atau icon identifier.'),
                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Urutan prioritas penampilan pada grid skills.'),
                                Toggle::make('featured')
                                    ->label('Featured')
                                    ->inline(false)
                                    ->default(false)
                                    ->helperText('Centang jika merupakan core competency yang di-highlight.'),
                            ]),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->helperText('Penjelasan singkat kedalaman pemahaman atau konteks implementasi skill.'),
                    ]),

                Section::make('Evidence & Relationships')
                    ->description('Hubungkan skill ini dengan project, pengalaman, dan sertifikat terkait.')
                    ->schema([
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
                        Select::make('certificates')
                            ->label('Certificates')
                            ->relationship('certificates', 'title')
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
            ]);
    }
}
