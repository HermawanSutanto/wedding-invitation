<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id', 'title', 'story_date', 'description', 'order'
    ];

    public function invitation() { return $this->belongsTo(Invitation::class); }
}