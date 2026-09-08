<?php

namespace App\Filament\Widgets;

use App\Enums\ContactMessageStatus;
use App\Models\ContactMessage;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactMessagesWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->take(5))
            ->heading('Recent Inbound Messages')
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->weight('bold'),
                TextColumn::make('email')
                    ->color('primary'),
                TextColumn::make('subject')
                    ->limit(40),
                TextColumn::make('type')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (ContactMessageStatus|string $state): string => match ($state instanceof ContactMessageStatus ? $state->value : $state) {
                        'unread' => 'danger',
                        'read' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->since(),
            ]);
    }
}
