<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class UsersTable
{
   public static function configure(Table $table): Table
   {
      return $table
         ->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('role')->badge()
               ->color(fn(string $state): string => match ($state) {
                  'admin' => 'danger',
                  'user' => 'success',
                  default => 'gray',
               }),
            Tables\Columns\TextColumn::make('email_verified_at')->dateTime()->sortable(),
            Tables\Columns\TextColumn::make('created_at')->since(),
         ])
         ->filters([
            Tables\Filters\SelectFilter::make('role')
               ->options([
                  'admin' => 'Admin',
                  'user' => 'User',
               ]),
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
