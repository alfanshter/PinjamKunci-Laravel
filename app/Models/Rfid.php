<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fasilitas()
    {
        return $this->belongsToMany(FasilitasRuangan::class, 'fasilitas_rfids', 'id_rfid', 'id_fasilitas');
    }
}
