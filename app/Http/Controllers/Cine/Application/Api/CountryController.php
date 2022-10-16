<?php

namespace App\Http\Controllers\Cine\Application\Api;

use Illuminate\Http\Request;


class CountryController extends \App\Http\Controllers\CountryController
{
    public function index()
    {
        return response()->json($this->getAllCountries());
    }
}
