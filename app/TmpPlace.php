<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpPlace extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'kerivnik', 'city', 'street', 'number', 'tel', 'email', 'site', 'categories_id',
    ];


}
