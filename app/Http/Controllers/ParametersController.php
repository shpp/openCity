<?php

namespace App\Http\Controllers;

use Log;
use Session;
use App\ParameterType;
use App\ParameterTitle;
use Illuminate\Http\Request;

class ParametersController extends Controller
{
    /**
     * Create a new controller instance.
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
        return view('parameters', compact('parameters', 'parameterTypes'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
            'parameter_type_id' => 'required',
        ]);
        ParameterTitle::create($request->toArray());
        Log::notice(auth()->user()->email . ' створив параметр ' . $request->name . ' ' . json_encode($request));
        Session::flash('status', 'Створено успішно!');
        return redirect('parameters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
            'parameter_type_id' => 'required',
        ]);
        ParameterTitle::findOrFail($id)->update($request->toArray());
        Log::notice(auth()->user()->email . ' зберіг назву параметру ' . $request->name . ' ' . json_encode($request));
        Session::flash('status', 'Збережено успішно!');
        return redirect('parameters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy($id)
    {
        $title = ParameterTitle::findOrFail($id);
        Log::notice(auth()->user()->email . ' видалив назву параметру ' . $title->name . ' ' . json_encode($title));
        $title::destroy($id);
        Session::flash('status', 'Видалено успішно!');
        return redirect('parameters');
    }
}
