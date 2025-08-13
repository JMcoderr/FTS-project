<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'festival_id',
        'capacity',
    ];

    // Relatie naar festival
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    // Relatie naar boekingen
    public function bookings()
    {
        return $this->belongsToMany(Booking::class)->withTimestamps();
    }
}
