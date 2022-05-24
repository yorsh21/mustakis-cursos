<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Postulation;
use App\Models\SchoolWorkshop;
use App\Models\Survey;

class PostulationController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Postulation.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $postulations = Postulation::all();
        $surveys = Survey::all()->pluck('name', '_id');

        return view('backend.postulation.index', compact('postulations', 'surveys'));
    }

    /**
     * Show the form for creating a new Postulation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $workshops = SchoolWorkshop::get(['id','name']);
        $periods = Period::get(['id','name']);
        $surveys = Survey::get(['id','name']);

        return view('backend.postulation.create', compact('workshops', 'periods', 'surveys'));
    }

    /**
     * Store a newly created Postulation in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'period_id' => 'required',
            'school_workshop_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        $requestData = $request->all();
        $requestData['documents'] = isset($request->documents) ? true : false;
        Postulation::create($requestData);

        return redirect()->route('postulation.index');
    }

    /**
     * Display the Postulation.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $postulation = Postulation::findOrFail($id);
        $surveys = Survey::all()->pluck('name', '_id');

        return view('backend.postulation.show', compact('postulation', 'surveys'));
    }

    /**
     * Show the form for editing the Postulation.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $postulation = Postulation::findOrFail($id);
        $periods = Period::get(['id','name']);
        $workshops = SchoolWorkshop::get(['id','name']);
        $surveys = Survey::get(['id','name']);
        
        return view('backend.postulation.edit', compact('postulation', 'periods', 'workshops', 'surveys'));
    }

    /**
     * Update the Postulation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $postulation = Postulation::findOrFail($id);
        $postulation->documents = isset($request->documents) ? true : false;
        $postulation->update($requestData);

        return redirect()->route('postulation.index');
    }

    /**
     * Remove the Postulation from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Postulation::destroy($id);

        return redirect()->route('postulation.index');
    }

}
