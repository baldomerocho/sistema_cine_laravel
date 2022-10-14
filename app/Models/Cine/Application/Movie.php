<?php

namespace App\Models\Cine\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'tagline',
        'original_title',
        'video',
        'status',
        'language',
        'poster_path',
        'backdrop_path',
        'imdb_id',
        'tmdb_id',
        'adult'
    ];

    public function genders()
    {
        return $this->belongsToMany(Gender::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }
}
