<?php

namespace App\Filament\Resources\Drugs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class DrugForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('dosage')
                    ->placeholder('e.g. 500mg twice a day'),

                Forms\Components\TagsInput::make('side_effects')
                    ->label('Side Effects'),

                Forms\Components\TagsInput::make('contraindications')
                    ->label('Contraindications'),
            ]);
    }
}