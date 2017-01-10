<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterTitle extends Model
{
    protected $fillable = [
        'id', 'name', 'comment',
    ]; 
	public function parameter()
	{
		return $this->hasMany('Parameter', 'param_title_id', 'id'); 
	}
}
