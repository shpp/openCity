<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessibilityTitle extends Model
{
    protected $fillable = [
        'id', 'name', 'comment',
    ]; 

    public function accessibility()
    {
        return $this->hasMany('App\accessibility', 'acces_title_id');
    }
}
