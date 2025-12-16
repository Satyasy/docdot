<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'birth_date',
        'height',
        'weight',
        'mental_condition',
        'medical_notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'medical_notes' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
