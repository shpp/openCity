<?php

namespace App\Http\Controllers;

use Session;
use App\Category;
use App\ParameterTitle;
use App\AccessibilityTitle;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function get_item($model, $id)
    {
        switch ($model) {
            case 'categories':
                return Category::where('id', $id)->firstOrFail();
            case 'param_name':
                return ParameterTitle::where('id', $id)->firstOrFail();
            case 'acc_name':
                return AccessibilityTitle::where('id', $id)->firstOrFail();
            default:
                abort(404);
        }
    }

    /**
     * Show items list.
     *
     * @param  Request $request , $id(name of list)
     * @return Response
     */
    public function index(Request $request, $id)
    {
        $data = '';
        $type = '';
        $view = '';
        switch ($id) {
            case 'categories':
                $data = Category::all();
                $type = 'categories';
                $view = 'Список категорій';
                break;
            case 'param_name':
                $data = ParameterTitle::all();
                $type = 'param_name';
                $view = 'Назви  параметрів';
                break;
            case 'acc_name':
                $data = AccessibilityTitle::all();
                $type = 'acc_name';
                $view = 'Назви доступностей';
                break;
        }
        return view('catalogue', [
            'datas' => $data,
            'types' => $type,
            'views' => $view,
        ]);
    }

    /**
     * Create a new item.
     *
     * @param  Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'comment' => $request->comment,
        ];
        switch ($request->type) {
            case 'categories':
                Category::create($data);
                break;
            case 'param_name':
                ParameterTitle::create($data);
                break;
            case 'acc_name':
                AccessibilityTitle::create($data);
                break;
            default:
                abort(404);
        }
        Session::flash('status', 'Додано успішно!');
        return redirect('catalogue/' . $request->type);
    }

    /**
     * Save item.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|max:255',
            'name' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        $data = [
            'name' => $request->name,
            'comment' => $request->comment,
        ];

        $item = $this->get_item($request->type, $request->id);
        $item->update($data);
        Session::flash('status', 'Збережено успішно!');
        return redirect('catalogue/' . $request->type);
    }

    /**
     * Delete item.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|max:255',
            'type' => 'required|max:255',
        ]);
        $item = $this->get_item($request->type, $request->id);
        $item->delete();
        Session::flash('status', 'Видалено успішно!');
        return redirect('catalogue/' . $request->type);
    }
}
