<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $table = 'kosts';
    protected $primaryKey = 'id_kost';

    protected $fillable = [
        'id_user',
        'nama_kost',
        'alamat_kost',
        'jenis_kost',
        'deskripsi_kost',
        'foto_kost',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'id_kost', 'id_kost');
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'id_kost', 'id_kost');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_kost', 'id_kost');
    }

    // Helper methods
    public function getAverageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getTotalReviews()
    {
        return $this->reviews()->count();
    }

    public function getMinPrice()
    {
        return $this->kamars()->min('harga_kamar') ?? 0;
    }

    public function hasAvailableRooms()
    {
        return $this->kamars()->where('status_kamar', 'tersedia')->exists();
    }
}