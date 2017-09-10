<?php

namespace App\Http\Controllers;

use Session;
use App\Place;
use App\Address;
use App\Category;
use GuzzleHttp\Client;
use App\ParameterTitle;
use App\AccessibilityTitle;
use Illuminate\Http\Request;

class PlaceAdminController extends Controller
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
     * Show places.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $cur_cat = 0;
        if (!isset($request->category)) {
            $places = Place::with('accessibility', 'parameter')->get();
        } else {
            if (0 == $request->category) {
                $places = Place::with('accessibility', 'parameter')->get();
            } else {
                $places = Place::where('category_id', $request->category)
                    ->with('accessibility', 'parameter')->get();
                $cur_cat = $request->category;
            }
        }
        return view('places', ['places' => $places,
            'categories' => $categories,
            'current_category' => $cur_cat,
        ]);
    }


    /**
     * Show edit page.
     *
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $categories = Category::all();
        $accessibilityTitle = AccessibilityTitle::all();
        $parameterTitle = ParameterTitle::all();
        $acc = [];
        $param = [];
        if ($id == 0) { // create place
            $place = New Place;
            $address = $place;
        } else { // edit place
            $place = Place::findOrFail($id);
            $accessibility = $place->accessibility()->get()->toArray();
            $parameter = $place->parameter()->get()->toArray();
            foreach ($accessibility as $value) {
                $acc[] = $value['acces_title_id'];
            }
            foreach ($parameter as $value) {
                $param[$value['param_title_id']] = $value['value'];
            }
        }
        return view('edit_place', ['place' => $place,
            'accessibilityTitle' => $accessibilityTitle,
            'сategories' => $categories,
            'parameterTitle' => $parameterTitle,
            'accessibility' => $acc,
            'param' => $param,
        ]);
    }

    /**
     * Create or save item.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
            'category' => 'required|max:5',
        ]);
        $data = [
            'name' => $request->name,
            'short_name' => $request->short_name,
            'comment' => $request->comment,
            'category_id' => $request->category,
            'city' => $request->city,
            'street' => $request->street,
            'number' => $request->number,
            'map_lat' => ($request->map_lat == '') ? NULL : $request->map_lat,
            'map_lng' => ($request->map_lng == '') ? NULL : $request->map_lng,
            'geo_place_id' => $request->geo_place_id,
            'comment_adr' => $request->comment_adr,
        ];
        if (empty($request->id)) {
            $place = Place::create($data);
        } else {
            $place = Place::where('id', $request->id)->firstOrFail();
            $place->update($data);
        }

        $accessibility = $place->accessibility()->get();
        $parameters = $place->parameter()->get();
        if (isset($request->acc)) {
            $acc_arr = $request->acc;
            foreach ($accessibility as $value) {
                if (!in_array($value->acces_title_id, $acc_arr)) {
                    $value->delete();
                }
            }
            foreach ($acc_arr as $value) {
                if (!$place->accessibility()
                    ->where('acces_title_id', $value)
                    ->first()) {
                    $place->accessibility()->create(['acces_title_id' => $value]);
                }
            }
        } else {
            foreach ($accessibility as $value) {
                $value->delete();
            }

        }

        if (isset($request->param)) {
            $param_arr = $request->param;
            foreach ($param_arr as $key => $value) {
                $parameter = $parameters->where('param_title_id', $key)->first();
                if (!empty($value)) {
                    if (NULL == $parameter) {
                        $place->parameter()->create(['param_title_id' => $key,
                            'value' => $value,
                        ]);
                    } else {
                        $parameter->update(['value' => $value]);
                    }
                } else {
                    if (!(NULL == $parameter)) {
                        $parameter->delete();
                    }
                }
            }
        }

        Session::flash('status', 'Інформація збережено успішно!');
        return redirect('places/' . $place->id . '/edit');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Place::destroy($id);
        \Log::info('user ' . auth()->user()->email . ' delete place ' . $id);
        \Session::flash('status', 'Видалено успішно!');
        return redirect('places');
    }

    public function destroyNull()
    {
        Place::where('name', null)->delete();
        Session::flash('status', 'Видалення нульових записів успішно!');
        return redirect('places');
    }

    /**
     * Set geolocation parameters to places in darabase
     *
     * @return \Illuminate\Http\Response
     */
    publiC function loadGeo()
    {
        //!!! http://guzzle.readthedocs.io/en/latest/index.html
        $client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/place/textsearch/',
            'timeout' => 10.0,
        ]);
        $addr_arr = Place::all()->where('geo_place_id', null)->get();
        $delay = 2;
        $my_api_key = env('GOOGLE_API_KEY');
        foreach ($addr_arr as $addr) {
            $req = 'json?query=' . $addr->city . '+' . $addr->street . '+' . $addr->number . '&language=uk&key=' . $my_api_key;
            $response = $client->request('POST', $req);
            sleep($delay);
            $result = json_decode($response->getBody(), true);
            if ($result['status'] === 'OK') {
                $result = $result['results'][0];
                $addr->map_lat = $result['geometry']['location']['lat'];
                $addr->map_lng = $result['geometry']['location']['lng'];
                $addr->geo_place_id = $result['id'];
                $addr->comment_adr = $result['formatted_address'];
                $addr->save();
                echo $addr->geo_place_id . ' ' . $addr->comment_adr . ' ' . $addr->map_lat . ' ' . $addr->map_lng . '  OK!<br/>';
            } else {
                echo 'Some troubles take with status: ' . $result['status'] . '<br/>';
                if ($result['status'] === 'OVER_QUERY_LIMIT') {
                    $delay++;
                }
            }
        }
    }
}
