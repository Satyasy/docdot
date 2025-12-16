<?php

namespace App\Filament\Resources\MedicalDocuments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class MedicalDocumentsTable
{
    public static function configure (Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('type')->badge(),
            Tables\Columns\IconColumn::make('verified')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->since(),
        ])
        ->recordActions([
                EditAction::make(),
            ])
        ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);

} }