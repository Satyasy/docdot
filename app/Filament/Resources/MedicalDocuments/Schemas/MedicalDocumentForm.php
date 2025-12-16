<?php

namespace App\Filament\Resources\MedicalDocuments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Illuminate\Support\Facades\Auth;

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
                        'guideline' => 'Medical Guideline',
                        'journal' => 'Journal',
                        'faq' => 'FAQ',
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

                Forms\Components\Hidden::make('uploaded_by')
                    ->default(Auth::id()),
            ]);
    }
}