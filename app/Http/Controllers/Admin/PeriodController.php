<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\Course;
use App\Models\Rol;

class PeriodController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Period.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $period = Period::all();

        return view('backend.period.index', compact('period'));
    }

    /**
     * Show the form for creating a new Period.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.period.create');
    }

    /**
     * Store a newly created Period in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Period::create($requestData);

        return redirect()->route('period.index');
    }

    /**
     * Display the Period.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $period = Period::findOrFail($id);

        return view('backend.period.show', compact('period'));
    }

    /**
     * Show the form for editing the Period.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $period = Period::findOrFail($id);

        return view('backend.period.edit', compact('period'));
    }

    /**
     * Update the Period in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $period = Period::findOrFail($id);
        $period->update($requestData);

        return redirect()->route('period.index');
    }

    /**
     * Remove the Period from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            Period::destroy($id);
        }
        return redirect()->route('period.index');
    }

    /**
     * Recalculate Scores of the current Period.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function recalculate(Request $request) 
    {
        $period = Period::findOrFail($request->id);
        $courses = Course::all();

        foreach ($courses as $course) {
            $count_users = 0;
            $sum_attendance = 0;

            foreach ($period->grades as $grade) {
                foreach ($grade->division_users as $user) {
                    if($user->user->rol_id == Rol::ALUMNO && $user->user->establishment == $course->id) {
                        $sum_attendance += $user->attendance_percentage;
                        $count_users++;
                    }
                }
            }

            if($count_users == 0) {
                $course->score = 0;
            }
            else {
                $attendance = ($sum_attendance/$count_users)/100;

                if($attendance >= 6/8) {
                    $course->score = 2;
                }
                elseif ($attendance >= 5/8 && $attendance < 6/8) {
                    $course->score = 1;
                }
                elseif ($attendance < 5/8 && $attendance > 0) {
                    $course->score = -1;
                }
                else {
                    $course->score = 0;
                }
            }
            $course->save();
        }

        return redirect()->route('course.scores');

    }
}
