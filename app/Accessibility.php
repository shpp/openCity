<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Accessibility
 *
 * @property int $id
 * @property int|null $place_id
 * @property int|null $acces_title_id
 * @property string|null $comment
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\AccessibilityTitle|null $accessibilityTitle
 * @property-read \App\Place|null $place
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Accessibility whereAccesTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Accessibility whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Accessibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Accessibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Accessibility wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Accessibility whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Accessibility extends Model
{
    protected $table = 'accessibilities';
    protected $fillable = [
        // fixme: migrate column and write access title id correctly, probably not shortened
        'name', 'place_id', 'acces_title_id', 'comment',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function accessibilityTitle()
    {
        return $this->belongsTo(AccessibilityTitle::class, 'acces_title_id', 'id');
    }
}
