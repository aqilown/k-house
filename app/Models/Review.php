<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'kost_id', 'user_id', 'booking_id', 
        'rating', 'komentar'
    ];

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}