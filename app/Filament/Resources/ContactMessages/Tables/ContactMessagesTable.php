<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(fn (ContactMessage $record) => $record->status === ContactMessageStatus::UNREAD ? 'bold' : 'normal'),
                TextColumn::make('email')
                    ->searchable()
                    ->color('primary')
                    ->copyable(),
                TextColumn::make('subject')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('type')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (ContactMessageStatus|string $state): string => match ($state instanceof ContactMessageStatus ? $state->value : $state) {
                        'unread' => 'danger',
                        'read' => 'success',
                        'replied' => 'info',
                        'archived' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'unread' => 'Unread',
                        'read' => 'Read',
                        'replied' => 'Replied',
                        'archived' => 'Archived',
                    ]),
            ])
            ->emptyStateHeading('No Messages Yet')
            ->emptyStateDescription('Belum ada inquiry yang masuk dari contact form.')
            ->recordActions([
                Action::make('markAsRead')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (ContactMessage $record) => ($record->status instanceof ContactMessageStatus ? $record->status->value : $record->status) === 'unread')
                    ->action(function (ContactMessage $record) {
                        $record->update(['status' => ContactMessageStatus::READ, 'read_at' => now()]);
                        Notification::make()->title('Success')->body('Pesan ditandai sebagai sudah dibaca.')->success()->send();
                    }),
                Action::make('markAsUnread')
                    ->label('Mark Unread')
                    ->icon('heroicon-o-envelope')
                    ->color('warning')
                    ->visible(fn (ContactMessage $record) => ($record->status instanceof ContactMessageStatus ? $record->status->value : $record->status) === 'read')
                    ->action(function (ContactMessage $record) {
                        $record->update(['status' => ContactMessageStatus::UNREAD]);
                        Notification::make()->title('Success')->body('Pesan ditandai belum dibaca.')->warning()->send();
                    }),
                Action::make('archive')
                    ->label('Archive')
                    ->icon('heroicon-o-archive-box')
                    ->color('gray')
                    ->visible(fn (ContactMessage $record) => ($record->status instanceof ContactMessageStatus ? $record->status->value : $record->status) !== 'archived')
                    ->action(function (ContactMessage $record) {
                        $record->update(['status' => ContactMessageStatus::ARCHIVED]);
                        Notification::make()->title('Success')->body('Pesan berhasil diarsipkan.')->send();
                    }),
                EditAction::make(),
                DeleteAction::make()
                    ->modalHeading('Delete Message?')
                    ->modalDescription('Pesan ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Delete')
                    ->modalCancelActionLabel('Cancel'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('markAsRead')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-check')
                        ->action(fn (Collection $records) => $records->each->update(['status' => ContactMessageStatus::READ, 'read_at' => now()])),
                    BulkAction::make('archive')
                        ->label('Archive')
                        ->icon('heroicon-o-archive-box')
                        ->action(fn (Collection $records) => $records->each->update(['status' => ContactMessageStatus::ARCHIVED])),
                    DeleteBulkAction::make()
                        ->modalHeading('Delete Selected Messages?')
                        ->modalDescription('Pesan yang dipilih akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Delete')
                        ->modalCancelActionLabel('Cancel'),
                ]),
            ]);
    }
}
