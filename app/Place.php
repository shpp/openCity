<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property int $id
 * @property string $name
 * @property int $address_id
 * @property int $category_id
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $city
 * @property string $street
 * @property string $number
 * @property string $geo_place_id
 * @property float $map_lat
 * @property float $map_lng
 * @property string $comment_adr
 * @property string $short_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Accessibility[] $accessibility
 * @property-read \App\Category $category
 * @property-read mixed $acc_cnt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Img[] $img
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Parameter[] $parameter
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereAddressId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereCommentAdr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereGeoPlaceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereMapLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereMapLng($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereShortName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'comment', 'category_id', 'address_id',
        'city', 'street', 'number', 'map_lat', 'map_lng',
        'geo_place_id', 'comment_adr', 'short_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at',];
    protected $appends = ['acc_cnt'];

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

    public function all_comments()
    {
        return $this->hasMany('App\PlaceComment');
    }

    public function comments()
    {
        return $this->all_comments()->whereHidden(0);
    }
}
