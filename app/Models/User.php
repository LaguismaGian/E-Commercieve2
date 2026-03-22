<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable; // ← ADD THIS
use App\Models\Order;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable; // ← ADD TwoFactorAuthenticatable

    // Columns that can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'two_factor_secret',           // ← ADD THIS
        'two_factor_recovery_codes',   // ← ADD THIS
        'two_factor_confirmed_at',     // ← ADD THIS
    ];

    // Columns that should be hidden (for security)
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',           // ← ADD THIS (hide from arrays/JSON)
        'two_factor_recovery_codes',   // ← ADD THIS
    ];

    // Columns that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime', // ← ADD THIS
    ];

    // A user can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}