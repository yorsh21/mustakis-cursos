<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Grade;
use App\Models\Period;
use App\Models\User;
use App\Models\Rol;

class CampusController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Campus.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $campus = Campus::all();
        $request->session()->forget(['current_path_campus', 'current_item_campus']);

        return view('backend.campus.index', compact('campus'));
    }

    /**
     * Show the form for creating a new Campus.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $regiones = Region::all();
        $comunas = Commune::orderBy('name')->get();
        $usuarios = User::where('rol_id', Rol::COORDINADOR)->orWhere('multiroles',Rol::COORDINADOR)->get();

        return view('backend.campus.create')
                ->with('regiones', $regiones)
                ->with('comunas', $comunas)
                ->with('usuarios', $usuarios);
    }

    /**
     * Store a newly created Campus in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Campus::create($requestData);

        return redirect()->route('campus.index');
    }

    /**
     * Display the Campus.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $campus = Campus::findOrFail($id);
        session(['current_path_campus' => 'campus']);
        session(['current_item_campus' => $id]);
        
        return view('backend.campus.show', compact('campus'));
    }

    /**
     * Show the form for editing the Campus.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $campus = Campus::findOrFail($id);
        $regiones = Region::all();
        $comunas = Commune::orderBy('name')->get();
        $usuarios = User::where('rol_id', Rol::COORDINADOR)->orWhere('multiroles',Rol::COORDINADOR)->get();
        
        return view('backend.campus.edit')
                ->with('campus', $campus)
                ->with('regiones', $regiones)
                ->with('comunas', $comunas)
                ->with('usuarios', $usuarios);
    }

    /**
     * Update the Campus in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $campus = Campus::findOrFail($id);
        $campus->update($requestData);
        
        return redirect()->route('campus.index');
    }

    /**
     * Remove the Campus from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            Campus::destroy($id);
        }
        return redirect()->route('campus.index');
    }

}
