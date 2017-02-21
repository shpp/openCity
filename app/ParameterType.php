<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
		return $this->hasOne('ParameterTitle', 'parameter_type_id', 'id'); 
	}
}
