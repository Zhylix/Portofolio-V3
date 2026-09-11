<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Resources\Pages\ListRecords;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    public function getSubheading(): ?string
    {
        return 'Inquiries dan pesan masuk dari contact form portfolio kamu.';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
