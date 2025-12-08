<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    protected $table = 'kost'; // ← Tambahkan ini!
    
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
}