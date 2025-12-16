<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'source',
        'content',
        'verified',
        'uploaded_by',
    ];

    protected $casts = [
        'verified' => 'boolean',
    ];

    public function embeddings()
    {
        return $this->hasMany(MedicalEmbedding::class);
    }
}
