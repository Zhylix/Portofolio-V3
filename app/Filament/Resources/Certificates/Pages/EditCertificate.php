<?php

namespace App\Filament\Resources\Certificates\Pages;

use App\Filament\Resources\Certificates\CertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCertificate extends EditRecord
{
    protected static string $resource = CertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->modalHeading('Delete Certificate?')
                ->modalDescription('Certificate ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Delete')
                ->modalCancelActionLabel('Cancel'),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Success')
            ->body('Certificate berhasil diperbarui.');
    }
}
