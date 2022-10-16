<?php

namespace App\Models\Cine\Application;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

}
