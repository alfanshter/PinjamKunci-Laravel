<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KpsController extends Controller
{
    function index()  {

        $getdata = User::where('role',3)->get();

        return view('kps.kps',[
            'data' => $getdata
        ]);
        

    }

    function kpsregister(Request $request)
    {

  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('/kps')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->password == $request->confirmpassword){
            $hashpassword = Hash::make($request->password);

            $savedata = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashpassword,
                'role' => 3
            ]);

    
    
            Session::flash('success', 'Registration Success');
    
            return redirect('/kps');
        }else{
            return redirect('/kps')
            ->with('gagal', 'password tidak sama');
        }
    
       
    }
}
