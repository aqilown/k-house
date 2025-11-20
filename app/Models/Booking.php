<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_user',
        'id_kamar',
        'tanggal_booking',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_booking',
        'total_harga',
        'bukti_pembayaran',
        'status_booking',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'durasi_booking' => 'integer',
        'total_harga' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status_booking === 'pending';
    }

    public function isDiterima()
    {
        return $this->status_booking === 'diterima';
    }

    public function isDitolak()
    {
        return $this->status_booking === 'ditolak';
    }

    public function getFormattedTotalPrice()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getStatusBadgeClass()
    {
        return match($this->status_booking) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'diterima' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}