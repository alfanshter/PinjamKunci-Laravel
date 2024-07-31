<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FasilitasRuangan;
use App\Models\Rfid;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    function index()
    {
        //admin

        $datamahasiswa = User::whereIn('role', [1, 2])->get();
        // $dataRfid = Rfid::where('status', 1)->get();
        $dataRfid = Rfid::all();

        $getBooking = Booking::where('status', 0)->with('user')->get();

        return view('booking.index', [
            'datamahasiswa' => $datamahasiswa,
            'dataBooking' => $getBooking,
            'dataRfid' => $dataRfid

        ]);

        //mahasiswa
        // if (auth()->user()->role == 1 || auth()->user()->role == 2) {
        //     $getBooking = Booking::where('status',0)->where('id_user',auth()->user()->id)->with('user')->get();

        //     return view('booking.index', [
        //         'dataBooking' => $getBooking    
        //     ]);
        // }

    }

    function storebooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_rfid' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/booking')
                ->withErrors($validator)
                ->withInput();
        }


        $waktu_mulai = $request->waktu_mulai;
        $durasi = $request->waktu_selesai;

        $dateTime = new DateTime($waktu_mulai);
        $interval = new DateInterval('PT' . $durasi . 'M');
        $dateTime->add($interval);

        $waktu_selesai = $dateTime->format('Y-m-d H:i:s');

        // Periksa apakah ada pemesanan tumpang tindih
        $cekJam = Booking::where('id_rfid', $request->id_rfid)
            ->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                $query->where(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '<=', $waktu_mulai)
                        ->where('waktu_selesai', '>=', $waktu_mulai);
                })->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '<=', $waktu_selesai)
                        ->where('waktu_selesai', '>=', $waktu_selesai);
                })->orWhere(function ($query) use ($waktu_mulai, $waktu_selesai) {
                    $query->where('waktu_mulai', '>=', $waktu_mulai)
                        ->where('waktu_selesai', '<=', $waktu_selesai);
                });
            })
            ->first();


        if ($cekJam != null) {
            return redirect('/booking')->with('failed', 'Jam sudah ada yang booking');
        }

        $savedata = Booking::create([
            'id_user' => $request->id_user,
            'id_rfid' => $request->id_rfid,
            'keterangan' => $request->keterangan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai
        ]);

        // //ubah status alat jadi tidak ready 
        $update = Rfid::where('id', $request->id_rfid)->update([
            'status' => 0
        ]);

        return redirect('/booking')->with('success', 'Data Berhasil Di Simpan');
    }

    function done(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/booking')
                ->withErrors($validator)
                ->withInput();
        }

        //update status 
        $update = Booking::where('id', $request->id)->update([
            'status' => 1
        ]);
        //update status rfid
        $update = Rfid::where('id', $request->id_rfid)->update([
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
        $datamahasiswa = User::whereIn('role', [1, 2])->get();
        $dataRfid = Rfid::where('status', 1)->get();

        $getBooking = Booking::where('status', 1)->with('user')->get();

        return view('booking.peminjaman', [
            'datamahasiswa' => $datamahasiswa,
            'dataBooking' => $getBooking,
            'dataRfid' => $dataRfid

        ]);
    }
}
