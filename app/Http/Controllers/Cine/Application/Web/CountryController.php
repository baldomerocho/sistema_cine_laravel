<?php

namespace App\Http\Controllers\Cine\Application\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends \App\Http\Controllers\CountryController
{
    public function index()
    {
        return view('cine.application.countries.index', [
            'countries' => $this->getAllCountries()
        ]);
    }
}
