<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Cine\Application\Movie;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function find_movie($query)
    {
        try{
            $search_encode = urlencode($query);
            $url_template = "https://api.themoviedb.org/3/search/movie?api_key=55b57be316afa143498d55e143f5e8a8&language=es-MX&query={$search_encode}&page=1&include_adult=false";
            $json = $this->get_request($url_template);
            return $json['results'];

        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
        }
    }


    public function update_movie($movie)
    {
        try{
            $url_template = "https://api.themoviedb.org/3/movie/{$movie}?api_key=55b57be316afa143498d55e143f5e8a8&language=es-MX";
            $json = $this->get_request($url_template);
            $json['tmdb_id'] = $json['id'];
            $save_movie = Movie::updateOrCreate(['tmdb_id' => $json['tmdb_id']], $json);
//            $save_movie->genders()->sync($json['genres']);
            return $save_movie;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }

    private function get_request($url)
    {
        $client = new \GuzzleHttp\Client();
        $request = new Request('GET', $url);
        $response = $client->send($request);
        return json_decode($response->getBody()->getContents(), true);
    }
}
