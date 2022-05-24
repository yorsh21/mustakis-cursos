<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolWorkshop;
use App\Models\Questionary;
use App\Models\Rol;

class SchoolWorkshopController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the SchoolWorkshop.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $schoolworkshop = SchoolWorkshop::all();
        $request->session()->forget(['current_path_school', 'current_item_school', 'current_path_block', 'current_item_block']);

        return view('backend.school-workshop.index', compact('schoolworkshop'));
    }

    /**
     * Show the form for creating a new SchoolWorkshop.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $schoolworkshopAll = SchoolWorkshop::all();

        return view('backend.school-workshop.create', compact('schoolworkshopAll'));
    }

    /**
     * Store a newly created SchoolWorkshop in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        SchoolWorkshop::create($requestData);

        return redirect()->route('school-workshop.index');
    }

    /**
     * Display the SchoolWorkshop.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $schoolworkshop = SchoolWorkshop::findOrFail($id);
        $questionnaires = Questionary::all()->pluck('name', '_id');

        session(['current_path_school' => 'talleres']);
        session(['current_item_school' => $id]);

        return view('backend.school-workshop.show', compact('schoolworkshop', 'questionnaires'));
    }

    /**
     * Show the form for editing the SchoolWorkshop.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $schoolworkshop = SchoolWorkshop::findOrFail($id);
        $schoolworkshopAll = SchoolWorkshop::all();
        
        return view('backend.school-workshop.edit', compact('schoolworkshop', 'schoolworkshopAll'));
    }

    /**
     * Update the SchoolWorkshop in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $schoolworkshop = SchoolWorkshop::findOrFail($id);
        $schoolworkshop->update($requestData);

        return redirect()->route('school-workshop.index');
    }

    /**
     * Remove the SchoolWorkshop from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            SchoolWorkshop::destroy($id);
        }
        return redirect()->route('school-workshop.index');
    }
}
