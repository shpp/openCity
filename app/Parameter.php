<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = [
        'id', 'place_id', 'param_title_id', 'value',
    ]; 
	public function place()
	{
		return $this->belongsTo('App\Place');
	}
	public function parameterTitle()
	{
		return $this->belongsTo('App\ParameterTitle', 'param_title_id', 'id');
	}
}
