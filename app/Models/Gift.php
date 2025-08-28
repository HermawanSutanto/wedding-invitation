<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id', 'bank_name', 'account_number', 'account_holder_name'
    ];

    public function invitation() { return $this->belongsTo(Invitation::class); }
}