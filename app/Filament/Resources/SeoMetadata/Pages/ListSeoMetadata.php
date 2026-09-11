<?php

namespace App\Filament\Resources\SeoMetadata\Pages;

use App\Filament\Resources\SeoMetadata\SeoMetadataResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeoMetadata extends ListRecords
{
    protected static string $resource = SeoMetadataResource::class;

    public function getSubheading(): ?string
    {
        return 'Kelola meta title, description, dan Open Graph untuk SEO portfolio.';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Add SEO Metadata'),
        ];
    }
}
