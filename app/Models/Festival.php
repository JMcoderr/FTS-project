<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'location',
        'price',
        'max_capacity',
    ];

    public function bookings()
{
    return $this->hasMany(\App\Models\Booking::class);
}}
