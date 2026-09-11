<?php

namespace App\Filament\Resources\Certificates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CertificatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('issuer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('credential_id')
                    ->searchable()
                    ->color('gray'),
                TextColumn::make('issued_at')
                    ->date('M Y')
                    ->sortable(),
                IconColumn::make('featured')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('skills.name')
                    ->badge()
                    ->color('gray')
                    ->limitList(2),
            ])
            ->filters([
                TernaryFilter::make('featured')
                    ->label('Featured Only'),
            ])
            ->emptyStateHeading('No Certificates Yet')
            ->emptyStateDescription('Belum ada certificate yang tersimpan. Start by adding your verified credentials.')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->modalHeading('Delete Certificate?')
                    ->modalDescription('Certificate ini akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Delete')
                    ->modalCancelActionLabel('Cancel'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->modalHeading('Delete Selected Certificates?')
                        ->modalDescription('Certificate yang dipilih akan dihapus permanently. Action ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Delete')
                        ->modalCancelActionLabel('Cancel'),
                ]),
            ]);
    }
}
