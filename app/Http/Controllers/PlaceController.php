<?php

namespace App\Http\Controllers;

use App\Place;
use App\Address;
use App\AccessibilityTitle;
use App\Category;
use App\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

use App\TmpPlace;

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
        $tmpData = TmpPlace::All()->toArray();
        foreach ($tmpData as $record)
        {
            $record['street'] = str_replace("вул. ", "", $record['street']);
            $addr = new Address($record);
            $address = Address::firstOrCreate($addr->toArray());
            $address->place()->create($record);
            $place_id = $address->place()->max('id');
            $param1 = new Parameter;
            $param2 = new Parameter;
            $param1->place_id = $place_id;
            $param2->place_id = $place_id;
            $param1->param_title_id = 1;
            $param2->param_title_id = 2;
            $param1->value = $record['kerivnik'];
            $param2->value = $record['tel'];
            $param1->save();
            $param2->save();
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
        //$my_api_key = 'AIzaSyC0sv23re_883wF08TXRjA1_8hNkq5-mww';
        $my_api_key = env('GOOGLE_API_KEY', false);
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
    publiC function GetPlaces_(Request $request) {
     if(isset($request->acc)){
         $access_all = DB::table('accessibility_titles')->whereIn('id', $request->acc)->count();
     }
     else{
         $access_all = DB::table('accessibility_titles')->count();
     }
    //-----------------------------------------------------------------
        if(isset($request->acc)) {

            $places = DB::table('places')->whereIn('category_id', $request->cat)
                ->join('addresses', 'places.address_id', '=', 'addresses.id')
                ->leftjoin('accessibilities', 'places.id', '=', 'accessibilities.place_id')
                ->whereIn('acces_title_id', $request->acc)
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
        }
        else if(isset($request->cat)){
            $places = DB::table('places')->whereIn('category_id', $request->cat)
                ->join('addresses', 'places.address_id', '=', 'addresses.id')
                ->leftjoin('accessibilities', 'places.id', '=', 'accessibilities.place_id')
                //->whereIn('acces_title_id', $request->acc)
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
        }
        else {
            $places = DB::table('places')//->whereIn('category_id', $request->cat)
                ->join('addresses', 'places.address_id', '=', 'addresses.id')
                ->leftjoin('accessibilities', 'places.id', '=', 'accessibilities.place_id')
                //->whereIn('acces_title_id', $request->acc)
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
        }
        return $places->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    publiC function getPlaces(Request $request)
    {
        $accessibilityCount = AccessibilityTitle::count();
        if (!isset($request->cat)) {
            return response()->json(['success' => true, 'places' => [], 'access_cnt_all' => $accessibilityCount], 200);
        }

        $acc = $request->acc;
        if (isset($acc)) {
            $places = Place::whereIn('category_id', $request->cat)
                ->whereHas('accessibility', function ($query) use ($acc) {
                    $query->whereIn('acces_title_id', $acc);
                })
                ->with('category')
                ->without('category_id')
                ->get();
        } else {
            $places = Place::whereIn('category_id', $request->cat)
                ->with('category')
                ->without('category_id')
                ->get();
        }

        return response()->json(['success' => true, 'places' => $places, 'access_cnt_all' => $accessibilityCount], 200);
    }


    /**
     * Get information about additional parameters of places
     *
     * @return \Illuminate\Http\Response
     */
    public function GetPlaceInfo(Request $request) {
        $info = DB::table('parameters')->where('place_id', $request->id)
            ->join('parameter_titles', 'parameters.param_title_id', '=', 'parameter_titles.id')
            ->select('parameters.place_id','parameter_titles.name','parameter_titles.comment','parameters.value')
            ->get()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        return $info;
    }


    /**
     * Get information about accessebilities of places
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlaceAccessibility(Request $request) {
        $info = DB::table('accessibilities')->where('place_id', $request->id)
            ->join('accessibility_titles', 'acces_title_id', '=', 'accessibility_titles.id')
            ->select('accessibilities.place_id','accessibility_titles.name','accessibility_titles.comment')
            ->get()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        return $info;
    }

    /**
     * Get all categories with comments
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories() {
        return Category::all()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
    }
    /**
     * Get all categories with comments
     *
     * @return \Illuminate\Http\Response
     */
    public function GetAccessebilities() {
        return AccessibilityTitle::all()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
    }
}
