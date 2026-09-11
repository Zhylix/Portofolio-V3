<?php

namespace App\Filament\Resources\Skills\Pages;

use App\Filament\Resources\Skills\SkillResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditSkill extends EditRecord
{
    protected static string $resource = SkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Delete Skill?')
                ->modalDescription('Skill ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Delete')
                ->modalCancelActionLabel('Cancel'),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Skill berhasil diperbarui.');
    }
}
