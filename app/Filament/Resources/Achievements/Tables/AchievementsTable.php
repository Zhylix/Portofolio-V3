<?php

namespace App\Filament\Resources\Achievements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('rank')
                    ->badge()
                    ->color('warning')
                    ->searchable(),
                TextColumn::make('organization')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->date('M Y')
                    ->sortable(),
                TextColumn::make('result')
                    ->searchable(),
                IconColumn::make('featured')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('featured')
                    ->label('Featured Only'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
