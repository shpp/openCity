<?php

namespace App\Http\Controllers;

use App\Place;
use App\Category;
use App\Parameter;
use App\Accessibility;
use App\ParameterTitle;
use App\AccessibilityTitle;
use Illuminate\Http\Request;

class ApiV1Controller extends Controller
{

    public function getPlaces(Request $request)
    {
        $accessibilityCount = AccessibilityTitle::count();
        if (!isset($request->cat)) {//if not set categories array
            if (isset($request->acc)) {// if set accessibility array has filter with him
                $places = Place::whereHas('accessibility',
                    function ($query) use ($acc) { // todo: fix it$acc is not defined
                        $query->whereIn('acces_title_id', $acc);
                    })->get();

            } else { // else not set accessibility array put all places
                $places = Place::all();
            }
        } else { // categories array is set
            $cat = $request->cat;
            if (isset($request->acc)) { // Have filter is two arrays
                $acc = $request->acc;
                $places = Place::whereIn('category_id', $cat)
                    ->whereHas('accessibility', function ($query) use ($acc) {
                        $query->whereIn('acces_title_id', $acc);
                    })->get();
            } else {//Have filter with categories array
                $places = Place::whereIn('category_id', $cat)->get();
            }
        }

        return response()->json([
            'success' => true,
            'places' => $places,
            'access_cnt_all' => $accessibilityCount,
        ], 200);
    }


    /**
     * Get information about additional parameters and accessebilities of places
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlaceInfo(Request $request)
    {
        $parameters = Parameter::where('place_id', $request->id)->get();
        $param = [];
        foreach ($parameters as $value) {
            $param[+$value->param_title_id] = $value->value;
        }

        $parameters = Accessibility::where('place_id', $request->id)->get();
        $acc = [];
        foreach ($parameters as $value) {
            $acc[] = $value->acces_title_id;
        }


        return response()->json(['parameters' => $param,
            'accessibilities' => $acc], 200);
    }

    /**
     * Get all categories with comments
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * Get all accessebilities with comments
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccessebilities()
    {
        $data = [];
        $accessibilityTitle = AccessibilityTitle::all();

        foreach ($accessibilityTitle as $value) {
            $data[$value->id] = ['name' => $value->name,
                'comment' => $value->comment,];
        }

        return response()->json($data, 200);
    }

    /**
     * Get all parameters with comments
     *
     * @return \Illuminate\Http\Response
     */
    public function getParameters()
    {
        $data = [];
        $parameters = ParameterTitle::all();

        foreach ($parameters as $value) {
            $data[$value->id] = ['name' => $value->name,
                'comment' => $value->comment,
                'type' => $value->parameterType->name,
                'icon' => $value->parameterType->icon,];
        }

        return response()->json($data, 200);
    }
}