<?php

namespace App\Http\Controllers;

use App\Place;

class PlacesController extends Controller
{
    public function all()
    {
        return view('places.all')->with(['places' => Place::with(['category',
            'accessibility' => function ($query) {
                $query->with(['accessibilityTitle']);
            },
            'parameter' => function ($query) {
                $query->with(['parameterTitle']);
            }])->get()]);
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        return view('places.show', compact('place'));
    }
}
