<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                IconColumn::make('featured')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('technologies.name')
                    ->badge()
                    ->color('gray')
                    ->limitList(3),
                TextColumn::make('started_at')
                    ->date('M Y')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                SelectFilter::make('status')
                    ->options([
                        'completed' => 'Completed',
                        'in_progress' => 'In Progress',
                        'planning' => 'Planning',
                        'maintained' => 'Active Maintenance',
                        'archived' => 'Archived',
                    ]),
                TernaryFilter::make('featured')
                    ->label('Featured Only'),
            ])
            ->emptyStateHeading('No Projects Yet')
            ->emptyStateDescription('Belum ada project yang ditambahkan. Start by creating your first project.')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->modalHeading('Delete Project?')
                    ->modalDescription('Project ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Delete')
                    ->modalCancelActionLabel('Cancel'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->modalHeading('Delete Selected Projects?')
                        ->modalDescription('Project yang dipilih akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Delete')
                        ->modalCancelActionLabel('Cancel'),
                ]),
            ]);
    }
}
