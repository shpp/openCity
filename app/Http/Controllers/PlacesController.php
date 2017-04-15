<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function all()
    {
        return view('places.all')->with(['places' => Place::all()]);
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);

        return view('places.show', compact('place'));
    }
}
