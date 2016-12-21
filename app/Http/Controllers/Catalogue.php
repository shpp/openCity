<?php

namespace App\Http\Controllers;

use App\Category;
use App\AccessibilityTitle;
use App\ParameterTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Catalogue extends Controller
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

    public function index(Request $request, $id)
    {
      echo "id = ".$id;
    	$data = '';
    	$type = '';
    	$view = '';
		switch ($id) {
			case 'categories':
				$data = Category::all();
		    	$type = 'categories';
		    	$view = 'Список категорий';
				break;
			case 'param_name':
				$data = ParameterTitle::all();
		    	$type = 'param_name';
		    	$view = 'Названия параметров';
			break;
			case 'acc_name':
				$data = AccessibilityTitle::all();
		    	$type = 'acc_name';
		    	$view = 'Названия доступности';
			break;
		}
		/*return view('catalogue', [
       			'datas' => $data,
       			'types' => $type,
       			'views' => $view,
   		]);			*/


       /* $AddInfo = AddInfo::where('id', $id)->firstOrFail();
        $AddInfo->delete();
        \Session::flash('status', 'Delete info success!');
        return redirect('/infos_list');*/
    }

}
