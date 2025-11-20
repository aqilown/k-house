<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_kost',
        'id_user',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Relationships
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'id_kost', 'id_kost');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Helper methods
    public function getStarsArray()
    {
        return range(1, 5);
    }
}