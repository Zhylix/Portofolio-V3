<?php

namespace App\Filament\Resources\Certificates\Schemas;

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

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Certificate Particulars')
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
                                TextInput::make('issuer')
                                    ->required(),
                                TextInput::make('credential_id')
                                    ->label('Credential ID / License No.'),
                                DatePicker::make('issued_at'),
                                DatePicker::make('expires_at'),
                                TextInput::make('credential_url')
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

                Section::make('Media & Relationships')
                    ->schema([
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
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->image(),
                    ]),
            ]);
    }
}
