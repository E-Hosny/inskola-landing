<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'message',
        'is_marked',
        'admin_note',
    ];

    protected $casts = [
        'is_marked' => 'boolean',
    ];
}

