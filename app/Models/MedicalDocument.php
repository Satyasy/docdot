<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'source',
        'content',
        'verified',
    ];

    protected $casts = [
        'verified' => 'boolean',
    ];

    public function embeddings(): HasMany
    {
        return $this->hasMany(MedicalEmbedding::class, 'document_id');
    }
}
