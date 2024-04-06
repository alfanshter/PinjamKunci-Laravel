<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    function index()
    {
        $getData = Ruangan::all();
       
        return view('ruangan.index',[
            'dataruangan' => $getData
        ]);
    }

    function storeruangan(Request $request)
    {
        //validasi

        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required|string|max:25|unique:ruangans',
            'status' => 'required|string|max:25'
        ]);

        if ($validator->fails()) {
            return redirect('/ruangan')
                ->withErrors($validator)
                ->withInput();
        }

        //save data
        $saveData = Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan,
            'status' => $request->status
        ]);
        
        return redirect('/ruangan')->with('berhasil','Data telah ditambahkan');

    }

    function edit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required|string|max:25|unique:ruangans',
            'status' => 'required|string|max:25'
        ]);

        if ($validator->fails()) {
            return redirect('/ruangan')
                ->withErrors($validator)
                ->withInput();
        }

        //update

        $updateData = Ruangan::where('id',$id)->update([
            'nama_ruangan' => $request->nama_ruangan,
            'status' => $request->status
        ]);

        return redirect('/ruangan')->with('berhasil','Data telah diupdate');

    }

    function destory($id) {
        //hapus data
        $delData = Ruangan::where('id',$id)->delete();

        return redirect('/ruangan')->with('berhasil','Data telah dihapus');

    }
    
}
