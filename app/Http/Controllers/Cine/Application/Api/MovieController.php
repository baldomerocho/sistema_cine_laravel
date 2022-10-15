<?php

namespace App\Http\Controllers\Cine\Application\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function search(Request $request)
    {
        $client = new \App\Http\Controllers\MovieController();
        return response()->json($client->find_movie($request['query']));
    }
}
