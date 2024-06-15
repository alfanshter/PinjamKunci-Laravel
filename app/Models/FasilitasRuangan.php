<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasRuangan extends Model
{
    protected $fillable = [
        'nama_fasilitas'
    ];

    public function rfids()
    {
        return $this->belongsToMany(Rfid::class, 'fasilitas_rfids', 'id_fasilitas', 'id_rfid');
    }
}
