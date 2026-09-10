<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Identity')
                    ->description('Personal identification, contact information, and availability status.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('headline')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('location')
                                    ->maxLength(255),
                                TextInput::make('availability')
                                    ->placeholder('e.g. Available for consulting')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Hero & Narrative Bios')
                    ->description('Public facing biography and hero banner texts.')
                    ->schema([
                        TextInput::make('hero_label')
                            ->placeholder('e.g. Software Engineer & System Architect'),
                        Textarea::make('hero_description')
                            ->rows(3),
                        Textarea::make('short_bio')
                            ->rows(3),
                        Textarea::make('long_bio')
                            ->rows(6),
                    ]),

                Section::make('Media & Documents')
                    ->description('Profile avatar and downloadable resume.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('avatar')
                                    ->collection('avatar')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(5120)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                SpatieMediaLibraryFileUpload::make('resume')
                                    ->collection('resume')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->maxSize(10240),
                            ]),
                    ]),
            ]);
    }
}
