<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    function index() {

        $getdata = User::where('role',1)->get();

        return view('mahasiswa.mahasiswa',[
            'datamahasiswa' => $getdata
        ]);
    }



}
