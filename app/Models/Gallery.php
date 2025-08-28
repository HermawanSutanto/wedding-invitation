<?php

namespace App\Models;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- TAMBAHKAN BARIS INI


class Gallery extends Model
{
     use HasFactory;

    protected $fillable = [
        'invitation_id', 'type', 'image_path', 'caption', 'order'
    ];

    /**
     * Mendefinisikan relasi: Sebuah foto galeri dimiliki oleh satu Invitation.
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
