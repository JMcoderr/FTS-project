<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Vulbare velden, zodat je deze kunt mass assignen
    protected $fillable = [
        'name',
        'email',
        'phone number',
        'address'
    ];


}
