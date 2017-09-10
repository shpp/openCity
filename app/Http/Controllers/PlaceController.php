<?php

namespace App\Http\Controllers;

use Log;
use Session;
use App\Place;
use App\Category;
use App\Parameter;
use App\PlaceComment;
use App\Accessibility;
use App\ParameterTitle;
use App\AccessibilityTitle;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * First load welcome page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app')
            ->with('categories', Category::all())
            ->with('accessibilities', AccessibilityTitle::all());
    }

    /**
     * Get places with filters
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPlaces(Request $request)
    {
        $access_cnt_all = AccessibilityTitle::count();
        if (!isset($request->cat)) {
            if (isset($request->acc)) {
                $places = Place::whereHas('accessibility',
                    function ($query) use ($acc) {
                        $query->whereIn('acces_title_id', $acc);
                    })->get();

            } else {
                $places = Place::all();
            }
        } else {
            $cat = $request->cat;
            if (isset($request->acc)) {
                $acc = $request->acc;
                $places = Place::whereIn('category_id', $cat)
                    ->whereHas('accessibility', function ($query) use ($acc) {
                        $query->whereIn('acces_title_id', $acc);
                    })->get();
            } else {
                $places = Place::whereIn('category_id', $cat)->get();
            }
        }
        return response()->json([
            'success' => true,
            'places' => $places,
            'access_cnt_all' => $access_cnt_all,
        ], 200);
    }


    /**
     * Get information about additional parameters of places
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPlaceInfo(Request $request)
    {
        $parameters = Parameter::where('place_id', $request->id)->get();
        $param = [];

        foreach ($parameters as $value) {
            $param[] = ['name' => $value->parameterTitle()->first()->name,
                'value' => $value->value,
            ];
        }

        $accessibilities = Accessibility::where('place_id', $request->id)->get();
        $acc = [];

        foreach ($accessibilities as $value) {
            $acc[] = $value->accessibilityTitle()->first()->name;
        }

        return response()->json([
            'success' => true,
            'parameters' => $param,
            'accessibilities' => $acc,
        ], 200);
    }


    /**
     * Simple search in Places
     * @param Request $req
     * @return \Illuminate\Http\Response
     */
    public function searchPlaces(Request $req)
    {
        if (isset($req->val)) {
            $places = Place::where('name', 'like', '%' . $req->val . '%')
                ->orWhere('comment_adr', 'like', '%' . $req->val . '%')
                ->get();
            return response()->json(['success' => true, 'places' => $places,], 200);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments($id)
    {
        // todo: make pagination
        // todo: hide author info
        $comments = PlaceComment::wherePlaceId($id)->with('author')->get();
        return response()->json(['data' => $comments, 'count' => $comments->count()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $accessibilityTitle = AccessibilityTitle::all();
        $parameterTitle = ParameterTitle::all();
        $categories = Category::all();
        return view('places.form', compact('categories', 'accessibilityTitle', 'parameterTitle'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // todo: refactor this
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
            'map_lat' => !$request->map_lat ? null : $request->map_lat,
            'map_lng' => !$request->map_lng ? null : $request->map_lng,
            'geo_place_id' => $request->geo_place_id,
            'comment_adr' => $request->comment_adr,
        ];
        if (empty($request->id)) {
            $place = Place::create($data);
        } else {
            $place = Place::findOrFail($request->id);
            $place->update($data);
        }

        $accessibility = $place->accessibility()->get();
        $parameters = $place->parameter()->get();
        if (isset($request->acc)) {
            $acc_arr = $request->acc;
            foreach ($accessibility as $value) {
                if (!in_array($value->acces_title_id, $acc_arr, true)) {
                    $value->delete();
                }
            }
            foreach ($acc_arr as $value) {
                if (!$place->accessibility()->where('acces_title_id', $value)->first()) {
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
                    if (null === $parameter) {
                        $place->parameter()->create(['param_title_id' => $key,
                            'value' => $value,
                        ]);
                    } else {
                        $parameter->update(['value' => $value]);
                    }
                } else {
                    if (!(null === $parameter)) {
                        $parameter->delete();
                    }
                }
            }

        }
        Log::info(auth()->user()->email . ' create new place ' . $request->name . ' id:' . $place->id);
        Session::flash('status', 'Інформація збережено успішно!');
        return redirect('places/' . $place->id . '/edit');
    }
}
