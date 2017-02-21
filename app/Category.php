<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id', 'name', 'comment',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function place()
    {
        return $this->hasMany('App\Place');
    }
}
