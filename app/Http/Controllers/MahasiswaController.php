<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    function index() {

        $getdata = User::where('role',1)->get();

        return view('mahasiswa.mahasiswa',[
            'datamahasiswa' => $getdata
        ]);
    }

    function mahasiswaregister(Request $request)
    {

  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('/mahasiswa')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->password == $request->confirmpassword){
            $hashpassword = Hash::make($request->password);

            $savedata = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashpassword,
                'role' => 1
            ]);

    
    
            Session::flash('success', 'Registration Success');
    
            return redirect('/mahasiswa');
        }else{
            return redirect('/mahasiswa')
            ->with('gagal', 'password tidak sama');
        }
    
       
    }



}
