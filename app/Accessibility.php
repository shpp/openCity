<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessibility extends Model
{
    protected $fillable = [
        'id', 'name', 'place_id', 'acces_title_id', 'comment',
    ]; 
	public function place()
	{
		return $this->belongsTo('App\Place');
	}
    public function accessibilityTitle()
    {
        return $this->belongsTo('App\AccessibilityTitle', 'acces_title_id');
    }

}
