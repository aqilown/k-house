<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama', 'email', 'password', 'no_telepon', 
        'tanggal_lahir', 'alamat', 'jenis_kelamin', 
        'pekerjaan', 'foto_profil', 'role'
    ];

    protected $hidden = ['password'];

    // Relationship
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}