<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
		return $this->hasMany('Parameter', 'param_title_id', 'id'); 
	}
    public function parameterType()
    {
        return $this->belongsTo('App\ParameterType', 'parameter_type_id', 'id');
    }
}
