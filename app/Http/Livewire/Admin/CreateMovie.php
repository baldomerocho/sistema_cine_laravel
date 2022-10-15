<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\MovieController;
use App\Models\Cine\Application\City;
use App\Models\Cine\Application\Country;
use App\Models\Cine\Application\Gender;
use App\Models\Cine\Application\Movie;
use App\Models\Cine\Application\Room;
use App\Models\Cine\Application\Show;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateMovie extends Component
{
    public $search_movie = "";
    public $search_results = [];
    public $movie_selected = null;

    public function mount()
    {
        $this->movie_selected = new Movie();
        $this->search_movie = "";
    }

    public function render()
    {
        $search_results = $this->search_results;
        return view('livewire.admin.create-movie', compact('search_results'));
    }

    public function find_movie()
    {
        $movie = new MovieController();
        $query = $this->search_movie;
        try {
            $data = $movie->find_movie($query);
            $this->search_results = $data;
        } catch (\Exception $_) {
            $this->emit('alert', 'error', 'Error al buscar la pelicula');
        }
    }

    public function update_movie($movie)
    {
        $up = new MovieController();
        try{
            $data = $up->update_movie($movie);
            $this->emit('alert', 'success', $data->title . ' :: base de datos actualizada');
        } catch (\Exception $_) {
            $this->emit('alert', 'error', 'Error al actualizar la pelicula');
        }


    }

}
