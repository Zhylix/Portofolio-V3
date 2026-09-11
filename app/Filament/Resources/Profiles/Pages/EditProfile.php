<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    public function getSubheading(): ?string
    {
        return 'Update informasi personal dan professional kamu.';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Delete Profile?')
                ->modalDescription('Data profile ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Delete')
                ->modalCancelActionLabel('Cancel'),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Profile berhasil diperbarui.');
    }
}
