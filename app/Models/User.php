<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email_user',
        'password',
        'role_user',
        'nomor_handphone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relationships
    public function kosts()
    {
        return $this->hasMany(Kost::class, 'id_user', 'id_user');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_user', 'id_user');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_user', 'id_user');
    }

    // Helper methods
    public function isPemilik()
    {
        return $this->role_user === 'pemilik';
    }

    public function isPencari()
    {
        return $this->role_user === 'pencari';
    }

    // Override getAuthPassword untuk custom column
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Override email field untuk auth
    public function getEmailForPasswordReset()
    {
        return $this->email_user;
    }
}   