<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $fillable = [
        'title', 'location', 'date', 'price', 'image_url', 'status', 'organizer'
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'integer',
    ];
}
