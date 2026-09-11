<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;

    public function getSubheading(): ?string
    {
        return 'Update informasi personal dan professional kamu.';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Add Profile'),
        ];
    }
}
