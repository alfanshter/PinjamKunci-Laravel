<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FasilitasRuangan;
use App\Models\Mode;
use App\Models\Rfid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RfidController extends Controller
{
    function index()
    {
        $fasilitas = FasilitasRuangan::all();
        $getData = Rfid::with('fasilitas')->get();

        return view('rfid.index', [
            'data' => $getData,
            'fasilitas' => $fasilitas,
        ]);
    }

    function registerRfid(Request $request)
    {
        //cek rfid
        $data = Rfid::where('uid', $request->uid)->first();
        //jika rfid belum terdaftar 
        if ($data != null) {
            return $response = [
                'message' => "uid sudah ada",
                'status' => 0
            ];
        }
        $save = Rfid::create(['uid' => $request->uid]);

        //ubah mode menjadi normal
        //update data  
        $update = Mode::query()->update(['mode' => 'scan']);

        return $response = [
            'message' => "Pendaftaran berhasil",
            'status' => 1
        ];
    }

    function edit(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:25|unique:rfids'
        ]);

        if ($validator->fails()) {
            return redirect('/rfid')
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = Rfid::where('id', $id)->update([
            'kode' => $request->kode,
        ]);

        return redirect('/rfid')->with('berhasil', 'Data Sukses Di Update');
    }

    function destroy($id)
    {
        $delData = Rfid::where('id', $id)->delete();

        return redirect('/rfid')->with('berhasil', 'Data Sukses Di Hapus');
    }

    function scanRfid(Request $request)
    {
        //cek rfid
        $data = Rfid::where('uid', $request->uid)->with('fasilitas')->first();
        //jika rfid tidak ada  
        if ($data == null) {
            return $response = [
                'message' => "RFID tidak ada",
                'status' => 0
            ];
        }

        //cek karu tidak sesuai 
        $cekKartu = Booking::where('id_rfid', $data->id)->where('status', 0)->first();
        //Kartu tidak sesuai
        if ($cekKartu == null) {
            return $response = [
                'message' => "Kartu tidak sesuai",
                'status' => 3
            ];
        }

        //cek rfid pada table booking
        $now = Carbon::now();
        $cekRfid = Booking::where('id_rfid', $data->id)->where('waktu_mulai', '<=', $now)
            ->where('waktu_selesai', '>=', $now)
            ->where('status', 0)
            ->first();
        //jika rfid gk sesuai tanggal booking maka gk akan bisa masuk
        if ($cekRfid == null) {
            return $response = [
                'message' => "Belum Booking",
                'status' => 2
            ];
        }

        //check in or checkout 
        if ($cekRfid->check_in == null) {
            $updateBooking = Booking::where('id', $cekRfid->id)->update([
                'check_in' => $now
            ]);
        }

        if ($cekRfid->check_in != null && $cekRfid->check_out == null) {
            $updateBooking = Booking::where('id', $cekRfid->id)->update([
                'check_out' => $now,
                'status' => 1
            ]);
        }

        return $response = [
            'message' => "Scan berhasil",
            'status' => 1,
            'data' => $data->fasilitas,
        ];
    }
}
