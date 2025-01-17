<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'phone',
        'role'
    ];
    public function getAuthPassword()
    {
        return $this->name; // Use the phone as the password
    }
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url',
    ];

    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
