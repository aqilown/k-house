<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'user_id', 'kamar_id', 'tanggal_checkin', 
        'tanggal_checkout', 'durasi_bulan', 'total_harga', 
        'status', 'metode_pembayaran', 'bukti_pembayaran', 'catatan'
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}