<?php

namespace App\Http\Controllers;

use App\Place;
use App\PlaceComment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function addPlaceComment($placeId, Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|max:2500',
        ]);

        $place = Place::findOrFail($placeId);
        PlaceComment::create([
            'author_id' => auth()->user()->id,
            'place_id' => $place->id,
            'comment' => htmlspecialchars($request->comment),
            'hidden' => false
        ]);

        return $request->ajax() ?
            response()->json(['message' => 'Comment added', 'err' => ''], 200) :
            redirect()->back()->with(['messages' => ['Коментар додано']]);
    }
}
