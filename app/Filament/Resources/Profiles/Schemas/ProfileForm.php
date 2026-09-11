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
                    ->description('Update informasi personal dan professional kamu.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('Nama lengkap kamu yang tampil di portfolio.'),
                                TextInput::make('headline')
                                    ->label('Headline')
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('Headline peran profesional (misal: Software Engineer & System Architect).'),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255)
                                    ->helperText('Alamat email utama untuk komunikasi.'),
                                TextInput::make('location')
                                    ->label('Location')
                                    ->maxLength(255)
                                    ->helperText('Lokasi domisili kamu saat ini.'),
                                TextInput::make('availability')
                                    ->label('Availability')
                                    ->placeholder('e.g. Available for Full-Time & Freelance Roles')
                                    ->helperText('Status ketersediaan kamu untuk peluang kerja atau project.')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Hero & Narrative Bios')
                    ->description('Teks perkenalan hero section dan bio naratif portfolio.')
                    ->schema([
                        TextInput::make('hero_label')
                            ->label('Hero Label')
                            ->placeholder('e.g. Software Engineer & System Architect')
                            ->helperText('Label kecil pembuka di atas nama pada hero section.'),
                        Textarea::make('hero_description')
                            ->label('Hero Description')
                            ->rows(3)
                            ->helperText('Deskripsi singkat di bawah nama pada halaman utama.'),
                        Textarea::make('short_bio')
                            ->label('Short Bio')
                            ->rows(3)
                            ->helperText('Ringkasan bio untuk kartu overview dan preview.'),
                        Textarea::make('long_bio')
                            ->label('Full Biography')
                            ->rows(6)
                            ->helperText('Narasi perjalanan profesional lengkap di halaman About.'),
                    ]),

                Section::make('Media & Documents')
                    ->description('Foto profil dan dokumen resume/CV kamu.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('avatar')
                                    ->label('Avatar Image')
                                    ->collection('avatar')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(5120)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->helperText('Foto profil utama berformat JPG, PNG, atau WebP.'),
                                SpatieMediaLibraryFileUpload::make('resume')
                                    ->label('Resume / CV PDF')
                                    ->collection('resume')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->maxSize(10240)
                                    ->helperText('File dokumen PDF resume atau CV kamu.'),
                            ]),
                    ]),
            ]);
    }
}
