<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public $incrementing = false;
    protected $keyType = 'string';

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
