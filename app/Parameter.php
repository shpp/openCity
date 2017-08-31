<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Parameter
 *
 * @property int $id
 * @property int $place_id
 * @property int $param_title_id
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\ParameterTitle $parameterTitle
 * @property-read \App\Place $place
 * @method static \Illuminate\Database\Query\Builder|\App\Parameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Parameter whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Parameter whereParamTitleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Parameter wherePlaceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Parameter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Parameter whereValue($value)
 * @mixin \Eloquent
 */
class Parameter extends Model
{
    protected $fillable = ['id', 'place_id', 'param_title_id', 'value',];
    protected $hidden = ['created_at', 'updated_at',];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function parameterTitle()
    {
        return $this->belongsTo(ParameterTitle::class, 'param_title_id', 'id');
    }
}
