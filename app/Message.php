<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email', 'text', 'read',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
