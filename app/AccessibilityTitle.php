<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessibilityTitle extends Model
{
    protected $fillable = [
        'id', 'name', 'comment',
    ]; 
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    
    public function accessibility()
    {
        return $this->hasMany('App\accessibility', 'acces_title_id', 'id');
    }
}