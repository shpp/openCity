<?php

namespace App\Http\Controllers;
use App\Place;
use App\Accessibility;
use App\Parameter;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
//use Illuminate\Http\Request;

class FilesController extends Controller
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

    public function index()
    {
		return view('load_file');			
    }

    public function load(Request $request)
    {
		$file = $request->file('uploadfile');
		//Move Uploaded File
		$destinationPath = 'uploads';
		$file->move($destinationPath,$file->getClientOriginalName());
		$fileFullName = $destinationPath.'/'.$file->getClientOriginalName();
		$file_array = '';
		if (file_exists($fileFullName)) {
			$file_array = Excel::selectSheetsByIndex(0)->load($fileFullName);
			$arr=[];
			$file_array->each(function($row) use (&$arr) {
				$arr[] = $row;
			});
			return view('import_file',['file_arr'=>$arr, 'file_name'=>$fileFullName]);
		}else{
        	\Session::flash('error', 'Помилка файла!');
			return view('load_file');
		} 
   }

    public function save(Request $request)
    {
		$file = $request->load_file;
		if (file_exists($file)) {
			$file_array = Excel::selectSheetsByIndex(0)->load($file);
			//$arr=[];
			$file_array->each(function($row){
				$place = Place::Create($row->toArray());
				$param_arr = ['',
							$row['director'],       
							$row['phone'],
                            $row['email'],
                            $row['www'],
                            ];
                $acc_arr = [ '',
                			$row['pandus'],
                            $row['knopka'],
                            ];
                for ($i=1; $i < count($param_arr); $i++) {
                	if ($param_arr[$i]) {
                		$param = new Parameter;
                		$param->place_id = $place->id;
                		$param->value = $param_arr[$i];
                        $param->param_title_id = $i;
                        $param->save(); 	
                	} 
                	
                }
                for ($i=1; $i < count($acc_arr); $i++) {
                	if ($acc_arr[$i]) {
                		$acc = new Accessibility;
                		$acc->place_id = $place->id;
                        $acc->acces_title_id = $i;
                        $acc->save(); 	
                	} 
                	
                }                
    		});
    		\Session::flash('status', 'Данні завантажено успішно!');
		}else{
        	\Session::flash('error', 'Помилка файла!');
		} 
		return view('load_file');
   }

      
}
