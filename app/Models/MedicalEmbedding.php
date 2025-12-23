<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalEmbedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'vector_id',
        'chunk_index',
    ];

    protected $casts = [
        'chunk_index' => 'integer',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(MedicalDocument::class, 'document_id');
    }
}
