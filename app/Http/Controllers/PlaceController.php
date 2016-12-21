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
            'timeout'  => 20.0,
        ]);
        $addr_arr = Address::All()->where('geo_place_id', null);

        // This KEY you can change to you valid Google API key
        $my_api_key = 'AIzaSyC0sv23re_883wF08TXRjA1_8hNkq5-mww';
        foreach ($addr_arr as $addr){
            $req = 'json?query='.$addr->city.'+'.$addr->street.'+'.$addr->number.'&language=uk&key='.$my_api_key;
            $response = $client->request('POST', $req);
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
                if($result['status'] == 'OVER_QUERY_LIMIT')
                   break;// sleep(1);
            }
        }
    }

    /**
     * Set geolocation parameters to places in darabase
     *
     * @return \Illuminate\Http\Response
     */
    publiC function GetPlaces() {
        $places = DB::table('places')
            ->join('addresses', 'places.address_id', '=', 'addresses.id')
            ->select('places.name',
                     'addresses.geo_place_id',
                     'addresses.map_lat',
                     'addresses.map_lng',
                     'addresses.city',
                     'addresses.street',
                     'addresses.number'
                     )
            ->get()->toJson(JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        return $places;
    }
}
