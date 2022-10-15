<?php

namespace Database\Seeders;

use App\Models\Cine\Application\Room;
use App\Models\Cine\Application\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::get();

        foreach ($rooms as $room) {
            $rows = ["A","B","C","D","F"];
            foreach ($rows as $row) {
                for($i = 1; $i<10; $i++){
                    try{
                        $room->seats()->create([
                            "name"=>$row.$i
                        ]);
                        Log::info($row.$i);
                    }catch (\Exception $e)
                    {
                        Log::error( $e->getMessage());
                    }
                }
            }

        }

    }
}
