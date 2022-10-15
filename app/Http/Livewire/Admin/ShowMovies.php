<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cine\Application\City;
use App\Models\Cine\Application\Country;
use App\Models\Cine\Application\Movie;
use App\Models\Cine\Application\Room;
use App\Models\Cine\Application\Show;
use Livewire\Component;

class ShowMovies extends Component
{
    public $country ;
    public $city;
    public $room;
    public $cities = [];

    public $create_show = [];

    public function render()
    {

        if($this->country!=null){
            $this->cities = City::where('country_id', $this->country)->get();
        }else{
            $this->cities = [];
        }
        if ($this->city!=null){
            $rooms = Room::where('city_id', $this->city)->get();
        }else{
            $rooms = [];
        }
        $movies = Movie::orderBy('release_date', 'desc')->with('shows_today')->paginate(10);
        $countries = Country::all();


        return view('livewire.admin.show-movies', compact('movies', 'countries', 'rooms'));
    }

    public function mount()
    {
        $this->country = Country::first()->id;
        $this->city = City::where('country_id', $this->country)->first()->id;
        $this->create_show = [];
    }

    // create_show is array with movie_id, city_id, room_id multiple
    public function createShow($id,Movie $movie)

    {
        $this->create_show[$id]["movie_id"] = $movie->id;
        $this->create_show[$id]["city_id"] = $this->city;
        $this->create_show[$id]["status"] = false;

        $vale = $this->validate([
            'create_show.'.$id.'.city_id' => 'required',
            'create_show.'.$id.'.room_id' => 'required',
            'create_show.'.$id.'.movie_id' => 'required',
            // start date is now or later
            'create_show.'.$id.'.start' => 'required|date|after_or_equal:today',
            'create_show.'.$id.'.price' => 'required',
        ]);
        if ($vale){
            $this->create_show[$id]["status"] = true;
            $room = Room::where('id', $this->create_show[$id]["room_id"])->first();

            $room->shows()->create([
                'movie_id' => $this->create_show[$id]["movie_id"],
                'start' => $this->create_show[$id]["start"],
                'end' => $this->duration_movie($this->create_show[$id]["start"], $movie),
                'price' => $this->create_show[$id]["price"],
            ]);
            unset($this->create_show[$id]);
            $this->emit('alert', 'success', 'Se ha creado la función');
        }
    }

    //return endtime of movie on datetime format
    public function duration_movie($start,$movie){
        $runtime = $movie->runtime;
        $start = strtotime($start);
        $end = date("Y-m-d H:i:s", strtotime("+$runtime minutes", $start));
        return $end;
    }

}
