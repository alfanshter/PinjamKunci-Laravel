<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_ruangan',
        'id_fasilitas'
    ];

    function fasilitas()
    {
        return $this->belongsTo(FasilitasRuangan::class, 'id_fasilitas', 'id');
    }

    function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
