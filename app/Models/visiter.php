<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','date_view', 'email', 'localisation', 'periode', 'tel'
    ];
}
