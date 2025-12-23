<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class UserForm
{
   public static function configure(Schema $schema): Schema
   {
      return $schema
         ->components([
            Forms\Components\TextInput::make('name')
               ->required()
               ->maxLength(255),

            Forms\Components\TextInput::make('email')
               ->email()
               ->required()
               ->unique(ignoreRecord: true)
               ->maxLength(255),

            Forms\Components\TextInput::make('password')
               ->password()
               ->required(fn(string $operation): bool => $operation === 'create')
               ->dehydrated(fn(?string $state) => filled($state))
               ->maxLength(255),

            Forms\Components\Select::make('role')
               ->options([
                  'admin' => 'Admin',
                  'user' => 'User',
               ])
               ->required()
               ->default('user'),

            Forms\Components\DateTimePicker::make('email_verified_at')
               ->label('Email Verified At'),
         ]);
   }
}
