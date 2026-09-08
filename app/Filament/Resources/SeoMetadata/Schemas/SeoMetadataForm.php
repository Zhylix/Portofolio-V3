<?php

namespace App\Filament\Resources\SeoMetadata\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SeoMetadataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Search Engine & Open Graph Metadata')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('meta_title')
                                    ->maxLength(255),
                                TextInput::make('canonical_url')
                                    ->url(),
                                TextInput::make('og_title')
                                    ->maxLength(255),
                                TextInput::make('og_image')
                                    ->url(),
                                TextInput::make('robots')
                                    ->default('index, follow'),
                            ]),
                        Textarea::make('meta_description')
                            ->rows(3),
                        Textarea::make('keywords')
                            ->rows(2)
                            ->placeholder('comma-separated keywords'),
                        Textarea::make('og_description')
                            ->rows(3),
                    ]),
            ]);
    }
}
