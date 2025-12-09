<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    protected $table = 'kost';
    
    protected $fillable = [
        'nama_kost', 'kategori', 'alamat', 'kota', 
        'kecamatan', 'deskripsi', 'peraturan', 
        'foto_utama', 'rating', 'jumlah_review'
    ];

    // Relationship
    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function foto()
    {
        return $this->hasMany(FotoKost::class);
    }
}