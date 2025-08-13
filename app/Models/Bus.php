<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['festival_id', 'name', 'capacity'];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
