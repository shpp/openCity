<?php

namespace App\Http\Controllers;

use App\Place;
use App\PlaceComment;
use Illuminate\Http\Request;

class PlaceCommentsController extends Controller
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

    public function delete($id, Request $request)
    {
        $placeComment = PlaceComment::findOrFail($id);
        if (!auth()->user()->hasRole('admin') && auth()->user()->id != $placeComment->author_id) {
            return $request->ajax() ?
                response()->json(['message' => 'You are not allowed to do this', 'err' => 'Forbidden'], 403) :
                abort(403);
        }

        $placeComment->delete();

        return $request->ajax() ?
            response()->json(['message' => 'Comment deleted', 'err' => ''], 200) :
            redirect()->back()->with(['messages' => ['Коментар видалено']]);
    }
}
