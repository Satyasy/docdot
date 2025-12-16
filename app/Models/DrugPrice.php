<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrugPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_id',
        'pharmacy_name',
        'price',
        'city',
        'updated_at',
    ];

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
