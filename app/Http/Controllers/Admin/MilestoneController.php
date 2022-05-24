<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Milestone;
use App\Models\Grade;
use App\Models\User;
use App\Models\Rol;

class MilestoneController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Milestones.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Store a newly created Milestone in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $milestone = Milestone::create($requestData);

        if($request->ajax()) {
            return response()->json(['milestone' => $milestone]);
        }
        else {
            return redirect()->route('milestone.index');
        }
    }

    /**
     * Update the Milestone in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $milestone = Milestone::findOrFail($id);
        $milestone->update($requestData);

        if($request->ajax()) {
            return response()->json(['milestone' => $milestone]);
        }
        else {
            return redirect()->route('milestone.index');
        }
    }

    /**
     * Remove the Milestone from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $milestone = Milestone::destroy($id);

        if($request->ajax()) {
            return response()->json(['milestone' => $milestone]);
        }
        else {
            return redirect()->route('milestone.index');
        }
    }

}
