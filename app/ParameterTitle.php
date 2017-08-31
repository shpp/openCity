<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ParameterTitle
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $comment
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $parameter_type_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Parameter[] $parameter
 * @property-read \App\ParameterType|null $parameterType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterTitle whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterTitle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterTitle whereParameterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterTitle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParameterTitle extends Model
{
    protected $fillable = [
        'id', 'parameter_type_id', 'name', 'comment',
    ]; 
    protected $hidden = [
        'created_at', 'updated_at',
    ];
	public function parameter()
	{
		return $this->hasMany(Parameter::class, 'param_title_id', 'id');
	}
    public function parameterType()
    {
        return $this->belongsTo(ParameterType::class, 'parameter_type_id', 'id');
    }
}
