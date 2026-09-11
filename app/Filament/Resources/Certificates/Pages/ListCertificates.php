<?php

namespace App\Filament\Resources\Certificates\Pages;

use App\Filament\Resources\Certificates\CertificateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCertificates extends ListRecords
{
    protected static string $resource = CertificateResource::class;

    public function getSubheading(): ?string
    {
        return 'Upload dan manage certificate yang sudah kamu dapatkan.';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Add Certificate'),
        ];
    }
}
