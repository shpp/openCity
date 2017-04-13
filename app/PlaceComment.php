<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceComment extends Model
{
    protected $table = 'place_comments';
    protected $fillable = ['id', 'author_id', 'author_id', 'author_name', 'comment', 'rating', 'place_id',
        'likes', 'dislikes', 'hidden'];
    protected $hidden = ['created_at', 'updated_at'];

//    todo: get author
//    todo: like. increment like column by 1
//    todo: dislike. increment dislike column by 1
//    todo: hide. change hidden to 1
//    todo: show. change hidden to 0
//    todo: votes. return difference of likes and dislikes

}
