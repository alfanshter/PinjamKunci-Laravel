<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{
    function index()  {

$getdata = FasilitasRuangan::all();

        return view('fasilitas.index',[
            'datafasilitas' => $getdata
        ]);
        
    }

    function  storefasilitas(Request $request) {

        $validator = Validator::make($request->all(),[
            'nama_fasilitas' => 'required|string|max:25|unique:fasilitas_ruangans'
        ]);

        
        
        if ($validator->fails()) {
            return redirect('/fasilitas')
            ->withErrors($validator)
            ->withInput();
        }


        $savedata = FasilitasRuangan::create([
            'nama_fasilitas' => $request->nama_fasilitas
        ]);
        

        return redirect('/fasilitas')->with('berhasil', 'Data Sukses Di Tambahkan');

    }

    function edit(Request $request, $id) {

        $validator = Validator::make($request->all(),[
            'nama_fasilitas' => 'required|string|max:25|unique:fasilitas_ruangans'
        ]);

        if ($validator->fails()) {
            return redirect('/fasilitas')
            ->withErrors($validator)
            ->withInput();
        }

        $updateData = FasilitasRuangan::where('id',$id)->update([
            'nama_fasilitas' => $request->nama_fasilitas,
        ]);

        return redirect('/fasilitas')->with('berhasil', 'Data Sukses Di Update');

    }

    function destroy($id) {
        $delData = FasilitasRuangan::where('id',$id)->delete();

        return redirect('/fasilitas')->with('berhasil', 'Data Sukses Di Hapus');
    }
}
