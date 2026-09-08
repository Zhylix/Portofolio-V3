<?php

namespace App\Filament\Resources\ExperienceTypes\Pages;

use App\Filament\Resources\ExperienceTypes\ExperienceTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExperienceType extends EditRecord
{
    protected static string $resource = ExperienceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
