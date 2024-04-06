<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    function index()  {

        $getdata = User::where('role',2)->get();

        return view('dosen.dosen',[
            'datadosen' => $getdata
        ]);
        

    }

    function dosenregister(Request $request)
    {

  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('/dosen')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->password == $request->confirmpassword){
            $hashpassword = Hash::make($request->password);

            $savedata = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashpassword,
                'role' => 2
            ]);

    
    
            Session::flash('success', 'Registration Success');
    
            return redirect('/dosen');
        }else{
            return redirect('/dosen')
            ->with('gagal', 'password tidak sama');
        }
    
       
    }

   
}
