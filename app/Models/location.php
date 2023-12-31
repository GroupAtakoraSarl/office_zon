<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_title', 'coords_lat', 'coords_lng', 'ville', 'pays'
    ];
}
