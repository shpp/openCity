<?php

namespace App\Http\Controllers;
use App\ParameterType;
use Illuminate\Http\Request;

class ParameterTypesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dir    = '/img/icons/';
        $files  = scandir(public_path() . $dir);
        $counts = count($files);
        $icons = [];
        for ($i=2; $i < $counts; $i++) { 
            $icons[] = $dir . $files[$i];
        }
        $parameterTypes = ParameterType::all();
        return view('parameter_types', ['icons' => $icons,
                                        'parameterTypes' => $parameterTypes,
                                        ]);          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
        ]);
        ParameterType::create($request->toArray());        
        \Session::flash('status', 'Створено успішно!');
        return redirect('parameter_types');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
        ]);
        ParameterType::findOrFail($id)->update($request->toArray());
        \Session::flash('status', 'Збережено успішно!');
        return redirect('parameter_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ParameterType::destroy($id);
        \Session::flash('status', 'Видалено успішно!');
        return redirect('parameter_types');
    }
}
