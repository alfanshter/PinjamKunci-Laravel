<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    function scanmode(Request $request) {
        //cek data model
        $data = Mode::latest()->first();
        //update data  
        $update = Mode::query()->update(['mode' => $request->mode]);

        return $response = [
            'message' => "Mode",
            'status' => 1
        ];
    }

    function getmode() {
        //cek data model
        $data = Mode::latest()->first();

        return $response = [
            'message' => "Mode",
            'data' => $data
        ];
    }

    
}
