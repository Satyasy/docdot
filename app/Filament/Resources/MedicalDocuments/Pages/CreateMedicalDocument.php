<?php

namespace App\Filament\Resources\MedicalDocuments\Pages;

use App\Filament\Resources\MedicalDocuments\MedicalDocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicalDocument extends CreateRecord
{
    protected static string $resource = MedicalDocumentResource::class;
}
