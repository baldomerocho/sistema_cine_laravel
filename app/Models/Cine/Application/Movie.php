<?php

namespace App\Models\Cine\Application;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UUID;

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
        'adult',
        'overview',
        'release_date',
        'runtime',
    ];

    // genders 'tmdb_id'
    public function genders()
    {
        return $this->belongsToMany(Gender::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function show_release_date()
    {
        return date('d-m-Y', strtotime($this->release_date));
    }

    // get shows today or future
    public function shows_today()
    {
        return $this->hasMany(Show::class)->where('start', '>=', date('Y-m-d H:i:s'));
    }

    //return how mucho time left to show


}
