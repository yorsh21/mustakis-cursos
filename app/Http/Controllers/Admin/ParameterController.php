<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Parameter;

class ParameterController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Parameter.
     *
     * @return \Illuminate\View\View
     */
    public function filter($type)
    {
        $parameter = Parameter::where('type', $type)->get();

        return view('backend.parameter.filter', compact('parameter', 'type'));
    }
    
    /**
     * Display a listing of the Parameter.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $parameter = Parameter::all();

        return view('backend.parameter.index', compact('parameter'));
    }

    /**
     * Show the form for creating a new Parameter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.parameter.create');
    }

    /**
     * Store a newly created Parameter in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        
        Parameter::create($requestData);

        return redirect()->route('parameter.index');
    }

    /**
     * Display the Parameter.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $parameter = Parameter::findOrFail($id);

        return view('backend.parameter.show', compact('parameter'));
    }

    /**
     * Show the form for editing the Parameter.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $parameter = Parameter::findOrFail($id);

        return view('backend.parameter.edit', compact('parameter'));
    }

    /**
     * Update the Parameter in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $parameter = Parameter::findOrFail($id);
        $parameter->update($requestData);

        return redirect()->route('parameter.index');
    }

    /**
     * Remove the Parameter from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Parameter::destroy($id);

        return redirect()->route('parameter.index');
    }
}
