<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FasilitasRuangan;
use App\Models\Rfid;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    function index()
    {
        //admin
        if (auth()->user()->role == 0) {
            $datamahasiswa = User::whereIn('role', [1, 2])->get();
            $dataRfid = Rfid::where('status', 1)->get();
    
            $getBooking = Booking::where('status',0)->with('user')->get();
    
            return view('booking.index', [
                'datamahasiswa' => $datamahasiswa,
                'dataBooking' => $getBooking,
                'dataRfid' => $dataRfid
    
            ]);
        }
        //mahasiswa
        if (auth()->user()->role == 1 || auth()->user()->role == 2) {
            $getBooking = Booking::where('status',0)->where('id_user',auth()->user()->id)->with('user')->get();
    
            return view('booking.index', [
                'dataBooking' => $getBooking    
            ]);
        }

    }

    function storebooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_rfid' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/booking')
                ->withErrors($validator)
                ->withInput();
        }

        $savedata = Booking::create([
            'id_user' => $request->id_user,
            'id_rfid' => $request->id_rfid
        ]);

        //ubah status alat jadi tidak ready 
        $update = Rfid::where('id', $request->id_rfid)->update([
            'status' => 0
        ]);

        return redirect('/booking')->with('success', 'Data Berhasil Di Simpan');
    }

    function done(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/booking')
                ->withErrors($validator)
                ->withInput();
        }

        //update status 
        $update = Booking::where('id',$request->id)->update([
            'status' => 1
        ]);
        //update status rfid
        $update = Rfid::where('id',$request->id_rfid)->update([
            'status' => 1
        ]);

        return redirect('/booking')->with('success', 'Berhasil di selesaikan');



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


    function peminjaman()
    {
        if (auth()->user()->role == 0 || auth()->user()->role == 3) {
            $datamahasiswa = User::whereIn('role', [1,2])->get();
            $dataRfid = Rfid::where('status', 1)->get();
    
            $getBooking = Booking::where('status',1)->with('user')->get();
    
            return view('booking.peminjaman', [
                'datamahasiswa' => $datamahasiswa,
                'dataBooking' => $getBooking,
                'dataRfid' => $dataRfid
    
            ]);
        }else if (auth()->user()->role == 1 || auth()->user()->role == 2) {
            $getBooking = Booking::where('status',1)->where('id_user',auth()->user()->id)->with('user')->get();
    
            return view('booking.peminjaman', [
                'dataBooking' => $getBooking    
            ]);
        }

    }
}
