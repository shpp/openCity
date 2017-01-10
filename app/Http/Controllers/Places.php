<?php
namespace App\Http\Controllers;

use App\Place;
use App\Address;
use App\Accessibility;
use App\AccessibilityTitle;
use App\Category;
use App\Img;
use App\Parameter;
use App\ParameterTitle;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Places extends Controller
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
    * @param  Request  $request
    * @return Response
    */
    public function index(Request $request)
    {
		$places = Place::all();
		$data = [];
		foreach ($places as $place) {
			$category = $place->category()->first();
			$address = $place->address()->first();
            $accessibility = $place->accessibility()->get();
			$param = $place->parameter()->get();
			$data[] = [
    			'id' => $place->id,
                'name' => $place->name,
                'category' => ($category) ? $category->name : "",
                'address' => $address,
                'param' => $param,
                'accessibility' => $accessibility,
            	];
		}
		return view('places', ['places' => $data]);
    }


    /**
    * Show edit page.
    *
    * @param  Request  $request
    * @return Response
    */
    public function edit(Request $request, $id)
    {
            $сategories = Category::all();
            $accessibilityTitle = AccessibilityTitle::all();
            $parameterTitle =  ParameterTitle::all();
            $acc = [];
            $param = [];
        if ($id == 0) {//create place
            $place = New Place;
            $address = New Address;
        }else{//edit place
            $place = Place::where('id', $id)->firstOrFail();
            $accessibility = $place->accessibility()->get()->toArray();
            $parameter = $place->parameter()->get()->toArray();
            $address = $place->address()->first();
            foreach ($accessibility as $value) {
                $acc[]  = $value['acces_title_id'];
            }
            foreach ($parameter as $value) {
                $param[$value['param_title_id']]  = $value['value'];
            }
        }
        return view('edit_place', ['place' => $place,
                                    'сategories' => $сategories,
                                    'accessibilityTitle' => $accessibilityTitle,
                                    'accessibility' => $acc,
                                    'parameterTitle' => $parameterTitle,
                                    'param' => $param,
                                    'adr' => $address,
            ]);
    }
 
    /**
    * Create or save item.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
            'category' => 'required|max:5',
        ]);
        $data = [
            'name' => $request->name,
            'comment' => $request->comment,
            'category_id' => $request->category,
        ];
        $addres = [ 'city' => $request->city,
                    'street' => $request->street,
                    'number' => $request->number,
                    'map_lat' => $request->map_lat,
                    'map_lng' => $request->map_lng,
                    'geo_place_id' => $request->geo_place_id,
                    'comment' => $request->addres_comment,
                    ];
        if (empty($request->id)) {
            $addr = new Address($addres);
            $address = Address::firstOrCreate($addr->toArray());
            $place = $address->place()->create($data);
        }else{
            $place = Place::where('id', $request->id)->firstOrFail();
            $place->update($data);
            $place->address()->update($addres);
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
                if (!$accessibility->find($value)) {
                    $place->accessibility()->create(['acces_title_id' => $value]);
                }
            }
        }else{
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
                    }else{
                        $parameter->update(['value' => $value]);   
                    }
                }else{
                    if (!(NULL == $parameter)) {
                        $parameter->delete();
                    }
                }
            }
        }

        \Session::flash('status', 'Save place success!');
        return redirect('places');
    }

    public function destroy(Request $request, $id)
    {
        $place = Place::where('id', $id)->firstOrFail();
        if (Place::where('address_id', $place->address_id)->count() == 1) {
            $place->address()->delete();
        }
        $place->accessibility()->forceDelete();
        $place->parameter()->forceDelete();
        $place->delete();
        \Session::flash('status', 'Delete place success!');
        return redirect('places');
    }
}