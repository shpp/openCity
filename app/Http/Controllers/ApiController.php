<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function filter(Request $request)
    {
        if (!$request->categories) {
            return response()->json(['data' => ['places' => []]]);
        }
        $categories = explode(',', $request->categories);

        if ($request->accessibility) {
            $accessibility = explode(',', $request->accessibility);
            $places = Place::whereIn('category_id', $categories)
                ->whereHas('accessibility', function ($query) use ($accessibility) {
                    $query->whereIn('acces_title_id', $accessibility);
                })
                ->with('category')
                ->without('category_id')
                ->get();
        } else {
            $places = Place::whereIn('category_id', $categories)->get();
        }

        return response()->json(['data' => ['places' => $places]], 200);
    }

}
