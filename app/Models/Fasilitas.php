<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    public $timestamps = false;

    protected $fillable = ['kost_id', 'nama_fasilitas', 'icon'];

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}