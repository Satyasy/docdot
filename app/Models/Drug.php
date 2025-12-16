<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'dosage',
        'side_effects',
        'contraindications',
    ];

    protected $casts = [
        'side_effects' => 'array',
        'contraindications' => 'array',
    ];

    public function prices()
    {
        return $this->hasMany(DrugPrice::class);
    }

    public function interactions()
    {
        return $this->hasMany(DrugInteraction::class);
    }
}
