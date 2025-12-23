<?php

namespace App\Filament\Resources\MedicalDocuments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class MedicalDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required(),

                Forms\Components\Select::make('type')
                    ->options([
                        'disease' => 'Disease',
                        'symptom' => 'Symptom',
                        'drug' => 'Drug',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('source')
                    ->label('Source / Publisher'),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('verified')
                    ->label('Verified by Medical Reviewer')
                    ->default(false),
            ]);
    }
}