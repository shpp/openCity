<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessibility extends Model
{
    protected $fillable = [
        'id', 'name', 'place_id', 'acces_title_id', 'comment',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function place()
    {
        return $this->belongsTo('App\Places');
    }

    public function accessibilityTitle()
    {
        return $this->belongsTo('App\AccessibilityTitle', 'acces_title_id', 'id');
    }

}
