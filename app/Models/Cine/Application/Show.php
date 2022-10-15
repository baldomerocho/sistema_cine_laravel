<?php

namespace App\Models\Cine\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Show extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'movie_id',
        'city_id',
        'room_id',
        'start',
        'end',
        'price',
    ];

    public function duration_in_minutos_and_seconds()
    {
        $start = strtotime($this->start);
        $end = strtotime($this->end);
        $diff = $end - $start;
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - $hours * 60 * 60) / 60);
        $secs = floor(($diff - $hours * 60 * 60 - $mins * 60));
        return $hours . 'h ' . $mins . 'm ' . $secs . 's';
    }

    // return start and end time in format 12:00 add AM or PM
    public function start_and_end_time()
    {
        $start = new \DateTime($this->start);
        $end = new \DateTime($this->end);
        return $start->format('g:i A') . ' - ' . $end->format('g:i A');

    }

    // check if show is today or tomorrow and return the day
    public function day()
    {
        $start = new \DateTime($this->start);
        $today = new \DateTime(date('Y-m-d'));
        $tomorrow = new \DateTime(date('Y-m-d', strtotime('tomorrow')));
        if ($start->format('Y-m-d') == $today->format('Y-m-d')) {
            return 'Hoy';
        } elseif ($start->format('Y-m-d') == $tomorrow->format('Y-m-d')) {
            return 'Mañana';
        } else {
            return $start->format('d-M-Y');
        }
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }



}
