<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'festival_id',
        'seats',
        'status',
        'total_price',
        'booked_at',
        'points_awarded',
    ];

    protected $casts = [
        'booked_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }
}
