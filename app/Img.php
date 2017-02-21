<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $fillable = [
        'id', 'place_id', 'path', 'comment',
    ]; 
    protected $hidden = [
        'created_at', 'updated_at',
    ];    
	public function place()
	{
		return $this->belongsTo('App\Place');
	}
}
