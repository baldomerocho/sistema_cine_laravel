<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cine\Application\City;
use App\Models\Cine\Application\Country;
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
    }
    public function render()
    {
        $search_results = $this->search_results;
        return view('livewire.admin.create-movie', compact('search_results'));
    }
    public function find_movie()
    {
        try{
            $search_encode = urlencode($this->search_movie);
            $url_template = "https://api.themoviedb.org/3/search/movie?api_key=55b57be316afa143498d55e143f5e8a8&language=es-MX&query={$search_encode}&page=1&include_adult=false";
            $json = $this->get_request($url_template);
            $this->search_results = $json['results'];
        }catch(\Exception $e){
            $this->emit('alert', 'error', 'Error al buscar la pelicula');
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
        }
    }

    public function add_movie($movie)
    {
        try{
            $url_template = "https://api.themoviedb.org/3/movie/{$movie}?api_key=55b57be316afa143498d55e143f5e8a8&language=es-MX";
            $json = $this->get_request($url_template);
            $json['tmdb_id'] = $json['id'];
            $save_movie = Movie::create($json);
            $this->emit('alert', 'success', $save_movie->title . ' agregada correctamente');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            $this->emit('alert', 'error', 'Error al guardar la pelicula');
        }
    }

    public function update_movie($movie)
    {
        try{
            $url_template = "https://api.themoviedb.org/3/movie/{$movie}?api_key=55b57be316afa143498d55e143f5e8a8&language=es-MX";
            $json = $this->get_request($url_template);
            $json['tmdb_id'] = $json['id'];
            $save_movie = Movie::updateOrCreate(['tmdb_id' => $json['tmdb_id']], $json);
            $this->emit('alert', 'success', $save_movie->title . ' actualizada correctamente');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            $this->emit('alert', 'error', 'Error al actualizar la pelicula');
        }
    }

    private function get_request($url)
    {
        $client = new \GuzzleHttp\Client();
        $request = new Request('GET', $url);
        $response = $client->send($request);
        return json_decode($response->getBody(), true);
    }
}
