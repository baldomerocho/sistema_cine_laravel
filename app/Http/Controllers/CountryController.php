<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Cine\Application\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryController extends Controller
{
    public function getAllCountries(): Collection
    {
        return Country::all();
    }
}
