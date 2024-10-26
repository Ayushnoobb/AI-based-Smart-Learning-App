<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function fetchData()
    {
        $data = [
            'message' => 'Hello from Laravel!',
            'status' => 'success',
        ];

        return response()->json($data);
    }
}
