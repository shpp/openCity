<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'comment', 'category_id', 'address_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function img()
    {
        return $this->hasMany('App\Img');
    }
    public function accessibility()
    {
        return $this->hasMany('App\Accessibility');
    }
    public function parameter()
    {
        return $this->hasMany('App\Parameter');
    }
}
