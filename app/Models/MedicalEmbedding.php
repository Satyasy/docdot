<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalEmbedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_document_id',
        'vector',
    ];

    protected $casts = [
        'vector' => 'array',
    ];

    public function document()
    {
        return $this->belongsTo(MedicalDocument::class);
    }
}
