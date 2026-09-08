<?php

namespace App\Filament\Resources\ExperienceTypes\Pages;

use App\Filament\Resources\ExperienceTypes\ExperienceTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExperienceTypes extends ListRecords
{
    protected static string $resource = ExperienceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
