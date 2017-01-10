<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

use App\Place;
use App\TmpPlace;
use SebastianBergmann\CodeCoverage\Report\PHP;

class PlaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function LoadFromFile()
    {
        DB::table('places')->delete();
        DB::table('addresses')->delete();
        $tmpData = TmpPlace::All()->toArray();
        foreach ($tmpData as $record)
        {
            $addr = new Address($record);
            $address = Address::firstOrCreate($addr->toArray());
            $address->place()->create($record);
        }
       \Session::flash('message', 'Data from temporary table was load successfully!');
        return view('home');
    }

    /**
     * Set geolocation parameters to places in darabase
     *
     * @return \Illuminate\Http\Response
     */
    publiC function LoadGeo() {
        //!!! http://guzzle.readthedocs.io/en/latest/index.html
        $client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/place/textsearch/',
            'timeout'  => 10.0,
        ]);
        $addr_arr = Address::All()->where('geo_place_id', null);
        $delay = 2;
        // This KEY you can change to you valid Google API key
        $my_api_key = 'AIzaSyC0sv23re_883wF08TXRjA1_8hNkq5-mww';
        foreach ($addr_arr as $addr){
            $req = 'json?query='.$addr->city.'+'.$addr->street.'+'.$addr->number.'&language=uk&key='.$my_api_key;
            $response = $client->request('POST', $req);
            sleep($delay);
            $result = json_decode($response->getBody(), true);
            if($result['status'] == 'OK') {
                $result = $result['results'][0];
                $addr->map_lat = $result['geometry']['location']['lat'];
                $addr->map_lng = $result['geometry']['location']['lng'];
                $addr->geo_place_id = $result['id'];
                $addr->comment = $result['formatted_address'];
                $addr->save();
                echo $addr->geo_place_id . ' ' . $addr->comment . ' ' . $addr->map_lat . ' ' . $addr->map_lng .'<br/>';
            }
            else {
                echo 'Some tuoubles take with status: '. $result['status'] . '<br/>';
                if($result['status'] == 'OVER_QUERY_LIMIT'){
                    $delay++;
                }

            }
        }
    }

    /**
     * Get all places from database
     *
     * @return \Illuminate\Http\Response
     */
    publiC function GetPlaces() {
    $access_all = DB::table('accessibility_titles')->count();
    //-----------------------------------------------------------------
        $places = DB::table('places')
            ->join('addresses', 'places.address_id', '=', 'addresses.id')
            ->leftjoin('accessibilities', 'places.id', '=', 'accessibilities.place_id')
            ->select(DB::raw("places.id,
                     places.name,
                     addresses.geo_place_id,
                     addresses.map_lat,
                     addresses.map_lng,
                     addresses.city,
                     addresses.street,
                     addresses.number, 
                     $access_all as access_all, 
                     count(accessibilities.place_id) as aceess_count")
                     )
            ->groupBy('places.id',
                'places.name',
                'addresses.geo_place_id',
                'addresses.map_lat',
                'addresses.map_lng',
                'addresses.city',
                'addresses.street',
                'addresses.number',
                'access_all'
                )
            ->get();
        return $places->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
    }

    /**
     * Get information about additional parameters of places
     *
     * @return \Illuminate\Http\Response
     */
    public function GetPlaceInfo(Request $request) {
        $info = DB::table('parameters')->where('parameters.place_id', '=', $request->id)
            ->join('parameter_titles', 'parameters.param_title_id', '=', 'parameter_titles.id')
            ->select('parameters.place_id','parameter_titles.comment','parameters.value')
            ->get()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        return $info;
    }


    /**
     * Get information about accessebilities of places
     *
     * @return \Illuminate\Http\Response
     */
    public function GetPlaceAccessebilities(Request $request) {
        $info = DB::table('accessibilities')->where('accessibilities.place_id', '=', $request->id)
            ->join('accessibility_titles', 'accessibilities.acces_title_id', '=', 'accessibility_titles.id')
            ->select('accessibilities.place_id','accessibility_titles.comment')
            ->get()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        return $info;
    }

    /**
     * Get all categories with comments
     *
     * @return \Illuminate\Http\Response
     */
    public function GetCategories() {
        $info = DB::table('categories')
            ->select('categories.id', 'categories.name', 'categories.comment')
            ->get()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        return $info;
    }
}
