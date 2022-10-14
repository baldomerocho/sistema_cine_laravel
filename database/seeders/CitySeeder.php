<?php

namespace Database\Seeders;

use App\Models\Cine\Application\City;
use App\Models\Cine\Application\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            $country = Country::firstOrFail();
            $cities = [
                [
                    'name'=> 'Ciudad Guatemala',
                    'country_id'=> $country->id
                ]
            ];
        } catch (\Exception $e){
            Log::error($e->getMessage());
        }
        foreach ($cities as $city)
        {
            City::create($city);
        }
    }
}
