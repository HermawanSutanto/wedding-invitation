<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'value',
        'count_gallery',
        'max_guests',
        'has_love_story',
        'has_music',
        'has_rsvp',
        'has_live_streaming',
        'is_featured',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'has_love_story' => 'boolean',
        'has_music' => 'boolean',
        'has_rsvp' => 'boolean',
        'has_live_streaming' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}