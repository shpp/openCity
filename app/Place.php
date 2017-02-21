<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Accessibility;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'comment', 'category_id', 'address_id',
        'city', 'street', 'number', 'map_lat', 'map_lng',
        'geo_place_id', 'comment_adr',
    ];

    protected $attributes = ['id', 'name', 'map_lat', 'map_lng'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['acc_cnt'];
    protected $relations = ['accessibility'];

    public function getAccCntAttribute()
    {
        return Accessibility::where('place_id', $this->attributes['id'])->count();
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
