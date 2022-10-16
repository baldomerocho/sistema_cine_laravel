<?php

namespace Database\Seeders;

use App\Models\Cine\Application\City;
use App\Models\Cine\Application\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            $city = City::firstOrFail();
            $rooms = [
                [
                    'name'=>'Sala 1',
                    'city_id'=>$city->id
                ],
                [
                    'name'=>'Sala 2',
                    'city_id'=>$city->id
                ],
                [
                    'name'=>'Sala 3',
                    'city_id'=>$city->id
                ]
            ];
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
