<?php

namespace App\Http\Controllers;

use App\Category;
use App\Accessibility;

class MapController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $accessibilities = Accessibility::all();
        return view('map.map', compact('categories', 'accessibilities'));
    }
}
