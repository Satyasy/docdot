<?php

namespace App\Filament\Resources\HealthArticles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Illuminate\Support\Facades\Auth;

class HealthArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('category')
                    ->options([
                        'mental' => 'Mental Health',
                        'physical' => 'Physical Health',
                        'nutrition' => 'Nutrition',
                        'general' => 'General',
                    ])
                    ->required(),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('source')
                    ->label('Reference Source'),

                Forms\Components\DateTimePicker::make('published_at'),

                Forms\Components\Hidden::make('created_by')
                    ->default(Auth::id()),
            ]);
    }
}