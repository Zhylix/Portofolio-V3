<?php

namespace App\Filament\Resources\Experiences\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ExperiencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('role')
                    ->searchable()
                    ->color('gray'),
                TextColumn::make('experienceType.name')
                    ->badge()
                    ->sortable(),
                TextColumn::make('organization.name')
                    ->label('Organization')
                    ->sortable()
                    ->placeholder('N/A'),
                IconColumn::make('is_current')
                    ->label('Current')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('started_at')
                    ->date('M Y')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('experience_type_id')
                    ->relationship('experienceType', 'name')
                    ->label('Type'),
                SelectFilter::make('status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                        'archived' => 'Archived',
                    ]),
                TernaryFilter::make('featured')
                    ->label('Featured Only'),
                TernaryFilter::make('is_current')
                    ->label('Ongoing Only'),
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
