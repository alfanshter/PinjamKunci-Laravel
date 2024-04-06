<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FasilitasRuangan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    function index()
    {
        $datamahasiswa = User::where('role', 1)->get();

        
        $dataFasilitas = FasilitasRuangan::all();
        $dataruangan = Ruangan::all();
        $getBooking = Booking::with('user')->get();
        $getBooking = Booking::with('fasilitas')->get();
        $getBooking = Booking::with('ruangan')->get();

        return view('booking.index', [
            'datamahasiswa' => $datamahasiswa,
            'dataFasilitas' => $dataFasilitas,
            'dataruangan' => $dataruangan,
            'dataBooking' => $getBooking

        ]);

    }

    function storebooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_ruangan' => 'required',
            'id_fasilitas' => 'required'

        ]);

        if ($validator->fails()) {
            return redirect('/booking')
                ->withErrors($validator)
                ->withInput();
        }

        $savedata = Booking::create([
            'id_user' => $request->id_user,
            'id_ruangan' => $request->id_ruangan,
            'id_fasilitas' => $request->id_fasilitas
        ]);

        return redirect('/booking')->with('success', 'Data Berhasil Di Simpan');
    }

    function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_ruangan' => 'required',
            'id_fasilitas' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/booking')
                ->withErrors($validator)
                ->withInput();
        }



        $updateData = Booking::where('id', $id)->update([
            'id_user' => $request->id_user,
            'id_ruangan' => $request->id_ruangan,
            'id_fasilitas' => $request->id_fasilitas
        ]);

        return redirect('/booking')->with('success', 'Data Berhasil Di Update');
    }

    function destroy($id)
    {
        
        $delData = Booking::where('id', $id)->delete();

        return redirect('/booking')->with('success', 'Data Berhasil Di Hapus');
    }
}
