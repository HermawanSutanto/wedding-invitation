<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'template_id', 'slug', 'groom_name', 'groom_info',
        'groom_photo_path', 'bride_name', 'bride_info', 'bride_photo_path',
        'quote', 'quote_source', 'status','cover_image', 'hero_image'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function template() { return $this->belongsTo(Template::class); }
    public function events() { return $this->hasMany(Event::class)->orderBy('order'); }
    public function stories() { return $this->hasMany(Story::class)->orderBy('order'); }
    public function galleries() { return $this->hasMany(Gallery::class)->orderBy('order'); }
    public function gifts() { return $this->hasMany(Gift::class); }
    public function guestbooks() { return $this->hasMany(Guestbook::class)->latest(); }
}