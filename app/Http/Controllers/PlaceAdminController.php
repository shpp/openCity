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
        $places = Place::with('accessibility', 'parameter')->get();
        return view('places', ['places' => $places]);
    }


    /**
     * Show edit page.
     *
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $сategories = Category::all();
        $accessibilityTitle = AccessibilityTitle::all();
        $parameterTitle = ParameterTitle::all();
        $acc = [];
        $param = [];
        if ($id == 0) {//create place
            $place = New Place;
            $address = $place;
        } else {//edit place
            $place = Place::where('id', $id)->firstOrFail();
            $accessibility = $place->accessibility()->get()->toArray();
            $parameter = $place->parameter()->get()->toArray();
            //$address = $place;
            foreach ($accessibility as $value) {
                $acc[] = $value['acces_title_id'];
            }
            foreach ($parameter as $value) {
                $param[$value['param_title_id']] = $value['value'];
            }
        }
        return view('edit_place', ['place' => $place,
            'accessibilityTitle' => $accessibilityTitle,
            'сategories' => $сategories,
            'parameterTitle' => $parameterTitle,
            'accessibility' => $acc,
            'param' => $param,
        ]);
    }

    /**
     * Create or save item.
     *
     * @param  Request $request
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
                    ->first()
                ) {
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

        \Session::flash('status', 'Інформація збережено успішно!');
        return redirect('places/' . $place->id . '/edit');
        //return redirect('places');
        //return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $place = Place::where('id', $id)->firstOrFail()->delete();
        \Session::flash('status', 'Видалено успішно!');
        return redirect('places');
    }
}