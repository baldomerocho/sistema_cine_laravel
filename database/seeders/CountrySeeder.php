<?php

namespace Database\Seeders;

use App\Models\Cine\Application\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'name' => 'Guatemala',
                'flag' => 'https://media.cdn.republica.gt/102021/1635393188228.jpg?cw=1200&ch=801'
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
