<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id', 'title', 'event_date', 'start_time', 'end_time',
        'venue_name', 'venue_address', 'dress_code_colors',
        'google_maps_link',    'livestream_link',
        'order'
    ];

    protected $casts = [
        'dress_code_colors' => 'array', // Otomatis konversi JSON ke array
    ];

    public function invitation() { return $this->belongsTo(Invitation::class); }
}