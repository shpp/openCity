<?php

namespace App\Http\Controllers;
use App\ParameterTitle;
use App\ParameterType;
use Illuminate\Http\Request;

class ParametersController extends Controller
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
        $parameterTypes = ParameterType::all();
        $parameters = ParameterTitle::all();
        return view('parameters', [ 'parameters' => $parameters,
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
            'parameter_type_id' => 'required',
        ]);
        ParameterTitle::create($request->toArray());        
        \Session::flash('status', 'Створено успішно!');
        return redirect('parameters');        
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
            'parameter_type_id' => 'required',
        ]);
        ParameterTitle::findOrFail($id)->update($request->toArray());
        \Session::flash('status', 'Збережено успішно!');
        return redirect('parameters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ParameterTitle::destroy($id);
        \Session::flash('status', 'Видалено успішно!');
        return redirect('parameters');
    }
}
