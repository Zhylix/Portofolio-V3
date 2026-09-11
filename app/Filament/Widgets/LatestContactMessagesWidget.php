<?php

namespace App\Filament\Widgets;

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactMessagesWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->take(5))
            ->heading('Recent Messages')
            ->description('Inquiries dan pesan masuk dari contact form portfolio kamu.')
            ->emptyStateHeading('No Messages Yet')
            ->emptyStateDescription('Belum ada inquiry yang masuk dari contact form.')
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->weight('bold'),
                TextColumn::make('email')
                    ->label('Email')
                    ->color('primary'),
                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(40),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (ContactMessageStatus|string $state): string => match ($state instanceof ContactMessageStatus ? $state->value : $state) {
                        'unread' => 'danger',
                        'read' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->since(),
            ]);
    }
}
