<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $fillable = [
        'id', 'place_id', 'path', 'comment',
    ]; 
	public function place()
	{
		return $this->belongsTo('App\Place');
	}
}
