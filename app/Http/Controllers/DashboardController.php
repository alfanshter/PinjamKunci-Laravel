<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRuangan;
use App\Models\Rfid;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $jumlahruangan = Rfid::count();
        $jumlahfasilitas = FasilitasRuangan::count();
        $jumlahmahasiswa = User::where('role', 1)->count();
        $jumlahdosen = User::where('role', 2)->count();
        $jumlahkps = User::where('role', 3)->count();
        $jumlahRuanganReady = Rfid::where('status', 1)->count();
        $jumlahRuanganDigunakan = Rfid::where('status', 0)->count();
    
        return view('dashboard.index', [
            'jumlahruangan' => $jumlahruangan,
            'jumlahfasilitas' => $jumlahfasilitas,
            'jumlahmahasiswa' => $jumlahmahasiswa,
            'jumlahdosen' => $jumlahdosen,
            'jumlahkps' => $jumlahkps,
            'jumlahRuanganReady' => $jumlahRuanganReady,
            'jumlahRuanganDigunakan' => $jumlahRuanganDigunakan,
        ]);
    }
    
}
