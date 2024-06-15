<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRfid;
use App\Models\Rfid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasRfidController extends Controller
{
    function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'id_rfid' => 'required|exists:rfids,id',
            'fasilitas' => 'array',
            'fasilitas.*' => 'integer|exists:fasilitas_ruangans,id',
        ]);
        


        // Temukan Rfid berdasarkan id
        $rfid = Rfid::findOrFail($request->id_rfid);

        // Sinkronkan fasilitas dengan Rfid
        $rfid->fasilitas()->sync($request->fasilitas);

        return redirect()->back()->with('berhasil', 'Fasilitas berhasil diperbarui!');
    }
}
