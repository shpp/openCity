<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ParameterType
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $icon
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\ParameterTitle $parameterTitle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ParameterType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParameterType extends Model
{
    protected $fillable = [
        'id', 'name', 'icon',
    ]; 
    protected $hidden = [
        'created_at', 'updated_at',
    ];
	public function parameterTitle()
	{
		return $this->hasOne(ParameterTitle::class, 'parameter_type_id', 'id');
	}
}
