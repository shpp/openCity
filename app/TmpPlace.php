<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TmpPlace
 *
 * @property int $id
 * @property string $name
 * @property string $kerivnik
 * @property string $city
 * @property string $street
 * @property string $number
 * @property string $tel
 * @property string $email
 * @property string $site
 * @property int|null $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereKerivnik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TmpPlace whereTel($value)
 * @mixin \Eloquent
 */
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
