<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AccessibilityTitle
 *
 * @property int $id
 * @property string $name
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Accessibility[] $accessibility
 * @method static \Illuminate\Database\Query\Builder|\App\AccessibilityTitle whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessibilityTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessibilityTitle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessibilityTitle whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AccessibilityTitle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccessibilityTitle extends Model
{
    protected $table = 'accessibility_titles';
    protected $fillable = ['name', 'comment',];
    protected $hidden = ['created_at', 'updated_at',];

    public function accessibility()
    {
        return $this->hasMany(Accessibility::class, 'acces_title_id', 'id');
    }

    public function places()
    {
        return $this->belongsToMany(Place::class, 'accessibilities', 'acces_title_id', 'place_id', 'id');

    }
}