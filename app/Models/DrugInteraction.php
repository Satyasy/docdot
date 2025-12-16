<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrugInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_id',
        'interacting_drug',
        'risk_level',
        'description',
    ];

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
