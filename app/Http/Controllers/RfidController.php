<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRuangan;
use App\Models\Mode;
use App\Models\Rfid;
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

    function edit(Request $request, $id) {

        $validator = Validator::make($request->all(),[
            'kode' => 'required|string|max:25|unique:rfids'
        ]);

        if ($validator->fails()) {
            return redirect('/rfid')
            ->withErrors($validator)
            ->withInput();
        }

        $updateData = Rfid::where('id',$id)->update([
            'kode' => $request->kode,
        ]);

        return redirect('/rfid')->with('berhasil', 'Data Sukses Di Update');

    }

    function destroy($id) {
        $delData = Rfid::where('id',$id)->delete();

        return redirect('/rfid')->with('berhasil', 'Data Sukses Di Hapus');
    }

    function scanRfid(Request $request) {
         //cek rfid
         $data = Rfid::where('uid', $request->uid)->with('fasilitas')->first();
         //jika rfid tidak ada  
         if ($data == null) {
             return $response = [
                 'message' => "RFID tidak ada",
                 'status' => 0
             ];
         }
          
         return $response = [
             'message' => "Scan berhasil",
             'status' => 1,
             'data' => $data->fasilitas,
         ];
    }
}
