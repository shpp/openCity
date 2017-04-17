<?php

namespace App\Http\Controllers;

use App\Place;
use App\Category;
use App\Parameter;
use App\PlaceComment;
use App\Accessibility;
use App\ParameterTitle;
use App\AccessibilityTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PlaceController extends Controller
{
    /**
     * First load welcome page
     *
     * @return \Illuminate\Http\Response
     */
    publiC function index()
    {
        $categories = Category::All();
        $accessibilities = AccessibilityTitle::All();

        return view('welcome')
            ->with('categories', $categories)
            ->with('accessibilities', $accessibilities);
    }

    /**
     * Get places with filters
     * @param
     *      cat[] - array of id's categories
     *      acc[] - array of id's accessibilities
     * @return \Illuminate\Http\Response
     */
    publiC function getPlaces(Request $request)
    {
        $access_cnt_all = AccessibilityTitle::count();
        if (!isset($request->cat)) {
            if (isset($request->acc)) {
                $places = Place::whereHas('accessibility',
                    function ($query) use ($acc) {
                        $query->whereIn('acces_title_id', $acc);
                    })->get();

            } else {
                $places = Place::all();
            }
        } else {
            $cat = $request->cat;
            if (isset($request->acc)) {
                $acc = $request->acc;
                $places = Place::whereIn('category_id', $cat)
                    ->whereHas('accessibility', function ($query) use ($acc) {
                        $query->whereIn('acces_title_id', $acc);
                    })->get();
            } else {
                $places = Place::whereIn('category_id', $cat)->get();
            }
        }
        return response()->json([
            'success' => true,
            'places' => $places,
            'access_cnt_all' => $access_cnt_all,
        ], 200);
    }


    /**
     * Get information about additional parameters of places
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlaceInfo(Request $request)
    {
        $parameters = Parameter::where('place_id', $request->id)->get();
        $param = [];
        foreach ($parameters as $value) {
            $param[] = ['name' => $value->parameterTitle()->first()->name,
                'value' => $value->value,
            ];
        }

        $accessibilities = Accessibility::where('place_id', $request->id)->get();
        $acc = [];
        foreach ($accessibilities as $value) {
            $acc[] = $value->accessibilityTitle()->first()->name;
        }

        return response()->json([
            'success' => true,
            'parameters' => $param,
            'accessibilities' => $acc,
        ], 200);
    }


    /**
     * Simple search in Places
     * @param val - request for search, must be name or adress
     * @return \Illuminate\Http\Response
     */
    public function searchPlaces(Request $req)
    {
        if (isset($req->val)) {
            $places = Place::where('name', 'like', '%' . $req->val . '%')
                ->orWhere('comment_adr', 'like', '%' . $req->val . '%')
                ->get();
            return response()->json(['success' => true, 'places' => $places,], 200);
        }
    }

    public function getComments($id)
    {
        // todo: make pagination
        // todo: hide author info
        $comments = PlaceComment::wherePlaceId($id)->with('author')->get();
        return response()->json(['data' => $comments, 'count' => $comments->count()]);
    }
}