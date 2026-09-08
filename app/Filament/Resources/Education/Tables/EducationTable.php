<?php

namespace App\Filament\Resources\Education\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EducationTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('institution')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('degree')
                    ->searchable(),
                TextColumn::make('major')
                    ->searchable(),
                IconColumn::make('is_current')
                    ->boolean()
                    ->label('Current')
                    ->sortable(),
                TextColumn::make('started_at')
                    ->date('Y')
                    ->sortable(),
                TextColumn::make('ended_at')
                    ->date('Y')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([])
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
