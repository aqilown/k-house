<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'id_kost',
        'tipe_kamar',
        'jumlah_kamar',
        'harga_kamar',
        'status_kamar',
        'deskripsi_kamar',
        'foto_kamar',
    ];

    protected $casts = [
        'harga_kamar' => 'decimal:2',
        'jumlah_kamar' => 'integer',
    ];

    // Relationships
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'id_kost', 'id_kost');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_kamar', 'id_kamar');
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->status_kamar === 'tersedia';
    }

    public function isFull()
    {
        return $this->status_kamar === 'terisi';
    }

    public function getFormattedPrice()
    {
        return 'Rp ' . number_format($this->harga_kamar, 0, ',', '.');
    }
}