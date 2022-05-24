<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DivisionUser;
use App\Models\User;
use App\Models\Rol;

class DivisionUserController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the DivisionUsers.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $divisionuser = DivisionUser::all();

        return view('backend.division-user.index', compact('divisionuser'));
    }

    /**
     * Show the form for creating a new DivisionUser.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.division-user.create');
    }

    /**
     * Store a newly created DivisionUSer in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function store(Request $request)
    {
        $user = User::find($request->user_id);

        if(is_null($user)) {
            return response()->json(['status' => -1, 'user_id' => $request->user_id]); 
        }

        if($user->rol_id == Rol::ALUMNO) {
            $division_user = DivisionUser::where([
                ['user_id', $request->user_id]
            ])->get()->filter(function($value) use($request){
                return $value->grade->period_id == $request->period_id;
            });
        }
        else {
            $division_user = DivisionUser::where([
                ['grade_id', $request->grade_id], 
                ['user_id', $request->user_id]
            ])->get();
        }
        

        if(count($division_user) == 0) {
            $division_new = DivisionUser::create([
                'grade_id' => $request->grade_id,
                'user_id' => $request->user_id,
                'rol' => $request->rol_id,
                'average_notes' => 0,
            ]);
            return response()->json(['status' => $division_new->id, 'user_id' => $request->user_id]); 
        }
        else {
            return response()->json(['status' => 0, 'user_id' => $request->user_id]); 
        }
    }

    /**
     * Display the DivisionUser.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $divisionuser = DivisionUser::findOrFail($id);

        return view('backend.division-user.show', compact('divisionuser'));
    }

    /**
     * Show the form for editing the DivisionUser.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $divisionuser = DivisionUser::findOrFail($id);

        return view('backend.division-user.edit', compact('divisionuser'));
    }

    /**
     * Update the DivisionUser in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $divisionuser = DivisionUser::findOrFail($id);
        $divisionuser->update($requestData);

        return redirect('/division-user');
    }

    /**
     * Remove the DivisionUser from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        DivisionUser::destroy($id);

        return redirect()->back();
    }

    /**
     * Remove the DivisionUser to Grade from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function destroy_from_grade(Request $request)
    {
        $division_user = DivisionUser::where([
            ['grade_id', $request->grade_id], 
            ['user_id', $request->user_id]
        ]);
        $division_user->delete();

        return response()->json(['user_id' => $request->user_id]); 
    }

    /**
     * Copy User->role_id to DivisionUser->rol.
     */
    public function copy_rol()
    {
        DivisionUser::each(function($item, $key) {
            $item->rol = $item->user->rol_id;
            $item->save();
        });
    }
}
