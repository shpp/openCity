<?php

namespace App\Http\Controllers;

use App\Place;
use App\Accessibility;
use App\AccessibilityTitle;
use App\Category;
use App\Img;
use App\Parameter;
use App\ParameterTitle;
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
    publiC function index() {
        $categories = Category::All();
        $accessibilities = AccessibilityTitle::All();

        return  view('welcome')
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
    publiC function getPlaces(Request $request) {
        $access_cnt_all = AccessibilityTitle::count();
        if (!isset($request->cat)) {
            if (isset($request->acc)) {
                $places = Place::whereHas('accessibility', 
                    function ($query) use ($acc) {
                        $query->whereIn('acces_title_id', $acc);
                    })->get();

            }else{
                $places = Place::all();    
            }
        }else{
            $cat = $request->cat;
            if (isset($request->acc)) {
                $acc = $request->acc;
                $places = Place::whereIn('category_id', $cat)
                ->whereHas('accessibility', function ($query) use ($acc) {
                    $query->whereIn('acces_title_id', $acc);
                })->get();
            }else{
                $places = Place::whereIn('category_id', $cat)->get();
            }
        }
        return response()->json([
            'success' => true,
            'places'  => $places,
            'access_cnt_all' => $access_cnt_all,
            ], 200);
    }


    /**
     * Get information about additional parameters of places
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlaceInfo(Request $request) {
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
            'parameters'  => $param,
            'accessibilities' => $acc,
            ], 200);
    }
}