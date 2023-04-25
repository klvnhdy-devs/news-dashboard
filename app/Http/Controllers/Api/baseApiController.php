<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class baseApiController extends Controller
{
    public function returnJson($data, $code)
    {
        $data = [
            'status' => 'success',
            'msg' => 'success fetch data news',
            'data' => $data
        ];
        return response()->json($data, $code);
    }
}
