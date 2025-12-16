<?php

namespace App\Filament\Resources\MedicalDocuments;

use App\Filament\Resources\MedicalDocuments\Pages\CreateMedicalDocument;
use App\Filament\Resources\MedicalDocuments\Pages\EditMedicalDocument;
use App\Filament\Resources\MedicalDocuments\Pages\ListMedicalDocuments;
use App\Filament\Resources\MedicalDocuments\Schemas\MedicalDocumentForm;
use App\Filament\Resources\MedicalDocuments\Tables\MedicalDocumentsTable;
use App\Models\MedicalDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MedicalDocumentResource extends Resource
{
    protected static ?string $model = MedicalDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MedicalDocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MedicalDocumentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMedicalDocuments::route('/'),
            'create' => CreateMedicalDocument::route('/create'),
            'edit' => EditMedicalDocument::route('/{record}/edit'),
        ];
    }
}
