<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // for login/auth
use Illuminate\Notifications\Notifiable;
use App\Models\Order;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Columns that can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Columns that should be hidden (for security)
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // Columns that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    // A user can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}