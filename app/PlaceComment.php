<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PlaceComment
 *
 * @property int $id
 * @property int $author_id
 * @property string $author_name
 * @property string $comment
 * @property int $rating
 * @property int $place_id
 * @property int $likes
 * @property int $dislikes
 * @property bool $hidden
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereAuthorName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereDislikes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereHidden($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereLikes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment wherePlaceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PlaceComment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\User $author
 */
class PlaceComment extends Model
{
    protected $table = 'place_comments';
    protected $fillable = ['id', 'author_id', 'author_name', 'comment', 'rating', 'place_id',
        'likes', 'dislikes', 'hidden'];
    protected $hidden = ['created_at', 'updated_at'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
//    todo: get author
//    todo: like. increment like column by 1
//    todo: dislike. increment dislike column by 1
//    todo: hide. change hidden to 1
//    todo: show. change hidden to 0
//    todo: votes. return difference of likes and dislikes

}
