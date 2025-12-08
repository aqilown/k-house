<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    protected $fillable = [
        'kost_id', 'tipe_kamar', 'harga_bulanan', 
        'ukuran', 'jumlah_tersedia', 'deskripsi', 'foto_kamar'
    ];

    // Relationship
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}