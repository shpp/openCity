<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Places;
use App\Address;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $places = Places::All()->where('geo_place_id', '<>', null);
        return view('welcome')->with(['places' => $places]);
    }
}
