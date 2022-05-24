<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Parameter;
use App\Models\Region;
use App\Models\Commune;

class CourseController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Show the form for creating a new Courses.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $regiones = Region::all();
        $comunas = Commune::orderBy('name')->get();

        return view('backend.course.create')
            ->with('regiones', $regiones)
            ->with('comunas', $comunas);
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->score = $request->score;
        $course->commune_id = $request->commune_id;
        $course->save();

        return redirect()->route('course.scores');
    }

    /**
     * Display a listing of Scores.
     *
     * @return \Illuminate\View\View
     */
    public function scores()
    {
        $courses = Course::all();

        return view('backend.course.scores', compact('courses'));
    }

    /**
     * Display a listing of the weighings.
     *
     * @return \Illuminate\View\View
     */
    public function weighings()
    {
        $scores = Parameter::where('type', 'scores')->pluck('value', 'key');
        $weighings = Parameter::where('type', 'weighing')->pluck('value', 'key');

        return view('backend.course.weighings', compact('scores', 'weighings'));
    }
    
    /**
     * Update the Courses in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function update_course(Request $request)
    {
        if($request->ajax()) {
            $course = Course::findOrFail($request->id);
            $course->score = $request->score;
            $course->save();
            
            return response()->json(['score', $course->score]);
        }
        else {
            return redirect()->route('course.scores');
        }
    }

    /**
     * Update the Score in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function update_score(Request $request)
    {
        $param = Parameter::where('key', $request->key)->first();
        $param->value = $request->score;
        $param->save();

        return response()->json(['score', $param->value]);
    }

    /**
     * Update the Weighings in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function update_weighings(Request $request)
    {
        $param = Parameter::where('key', $request->key)->first();
        $param->value = $request->weighings;
        $param->save();

        return response()->json(['weighings', $param->value]);
    }
    
}
