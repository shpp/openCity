<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Img
 *
 * @property int $id
 * @property int|null $place_id
 * @property string|null $path
 * @property string|null $comment
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Place|null $place
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Img whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Img whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Img whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Img wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Img wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Img whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
		return $this->belongsTo(Place::class);
	}
}
