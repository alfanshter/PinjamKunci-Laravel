<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index()
    {
        return view('auth.user');
    }

    function login(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        // Proses autentikasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            //jika berhasil login
            return redirect()->intended('dashboard');
        }



        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    function registerView()
    {
        return view('auth.register');
    }


    function register(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmpassword' => 'required|string|min:8',
            

        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->password == $request->confirmpassword){
            $hashpassword = Hash::make($request->password);

            $savedata = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashpassword,
            ]);
    
    
            Session::flash('success', 'Registration Success');
    
            return redirect('/login');
        }else{
            return redirect('/register')
            ->with('gagal', 'password tidak sama');
        }
    
       
    }

    function logout(Request $request)  {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
