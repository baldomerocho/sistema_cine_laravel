<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cine\Application\Movie;
use Livewire\Component;

class ShowMovies extends Component
{
    public function render()
    {
        $movies = Movie::orderBy('release_date', 'desc')->get();
        return view('livewire.admin.show-movies', compact('movies'));
    }
}
