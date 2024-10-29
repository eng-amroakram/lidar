<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'participants_number',
        'recording_attempts',
        'username',
        'id_number',
        'status',
        'restricted_image',
    ];
}
