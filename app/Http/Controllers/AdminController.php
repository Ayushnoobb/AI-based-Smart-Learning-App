<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'message' => 'Hello from Laravel!',
            'status' => 'success',
        ];

        return response()->json($data);
    }
}
