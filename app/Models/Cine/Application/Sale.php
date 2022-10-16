<?php

namespace App\Models\Cine\Application;

use App\Models\User;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UUID;

    protected $fillable = [
        'show_id',
        'user_id',
        'consumer_id',
        'currency_id',
        'ticket',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consumer()
    {
        return $this->belongsTo(User::class,'consumer_id');
    }


    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class);
    }

    public function count_seats()
    {
        return $this->seats()->count();
    }

    // show created_at in format "ago time"
    public function created_at_ago()
    {
        return $this->created_at->diffForHumans();
    }

}
