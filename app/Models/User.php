<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function chatSessions(): HasMany
    {
        return $this->hasMany(ChatSession::class);
    }

    public function aiAuditLogs(): HasMany
    {
        return $this->hasMany(AiAuditLog::class);
    }

    public function mentalHealthLogs(): HasMany
    {
        return $this->hasMany(MentalHealthLog::class);
    }

    public function physicalHealthLogs(): HasMany
    {
        return $this->hasMany(PhysicalHealthLog::class);
    }

    public function healthInsights(): HasMany
    {
        return $this->hasMany(HealthInsight::class);
    }
}
