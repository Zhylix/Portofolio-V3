<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable(),
                IconColumn::make('featured')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('projects_count')
                    ->counts('projects')
                    ->label('Projects')
                    ->sortable(),
                TextColumn::make('experiences_count')
                    ->counts('experiences')
                    ->label('Experiences')
                    ->sortable(),
                TextColumn::make('certificates_count')
                    ->counts('certificates')
                    ->label('Certificates')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('skill_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                TernaryFilter::make('featured')
                    ->label('Featured Only'),
            ])
            ->emptyStateHeading('No Skills Yet')
            ->emptyStateDescription('Belum ada skill yang ditambahkan. Start by defining your core competencies.')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->modalHeading('Delete Skill?')
                    ->modalDescription('Skill ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Delete')
                    ->modalCancelActionLabel('Cancel'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->modalHeading('Delete Selected Skills?')
                        ->modalDescription('Skill yang dipilih akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Delete')
                        ->modalCancelActionLabel('Cancel'),
                ]),
            ]);
    }
}
