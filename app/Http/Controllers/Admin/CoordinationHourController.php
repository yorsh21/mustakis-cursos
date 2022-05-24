<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Rol;
use App\Models\Task;
use App\Models\TaskPeriod;
use App\Models\Period;
use App\Models\Campus;
use App\Models\Grade;
use App\Models\CoordinationHour;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoordinationHourController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Coordination Hours.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $coordination_hours = CoordinationHour::all();

        return view('backend.coordination-hour.index', compact('coordination_hours'));
    }

    /**
     * Display a listing of the Coordination Hours.
     *
     * @return \Illuminate\View\View
     */
    public function distribution()
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $periods = Period::orderby("id", "DESC")->get();
            $campus = Campus::orderby("id", "DESC")->get();
        }
        elseif(Auth::user()->rol_id == Rol::COORDINADOR) {
            $periods = Period::orderby("id", "DESC")->get();
            $campus = Campus::where('user_id', Auth::user()->id)->orderby("id", "DESC")->get();
        }
        else {
            return redirect()->back();
        }

        return view('backend.coordination-hour.distribution', compact('periods', 'campus'));
    }

    /**
     * Display a listing of the Coordination Hours.
     *
     * @param Integer $period_id
     *
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'period_id' => 'required',
            'campus_id' => 'required',
        ]);

        $period_id = $request->period_id;
        $campus_id = $request->campus_id;

        if(Auth::user()->rol_id == Rol::COORDINADOR) {
            $periods = Period::orderby("id", "DESC")->get();
            $campus = Campus::where('user_id', Auth::user()->id)->orderby("id", "DESC")->get();
        }
        else {
            $periods = Period::orderby("id", "DESC")->get();
            $campus = Campus::orderby("id", "DESC")->get();
        }
        
        $period = Period::find($period_id);
        $campu = Campus::find($campus_id);
        
        $users = collect();
        Grade::where([
            ['campus_id', $campus_id],
            ['period_id', $period_id]
        ])->each(function($grade, $key) use($users){
            foreach ($grade->division_users as $division) {
                if($division->rol == Rol::PROFESOR) {
                    $users->push($division->user);
                }
            }
        });

        $tasks = Task::all();
        $coordination_hour = CoordinationHour::where([
            ["period_id", $period_id],
            ["campus_id", $campus_id]
        ])->first();
        

        $assigned = "";
        if(!is_null($coordination_hour) && $tasks->first()->task_periods->where('coordination_hour_id', $coordination_hour->id)->count() != 0) {
            $assigned = "disabled";
        }
        
        $commune = Auth::user()->city_assist_workshop;

        return view('backend.coordination-hour.task_period', compact('commune', 'periods', 'campus', 'period', 'campu', 'tasks', 'coordination_hour', 'users', 'assigned'));
    }

    /**
     * Show the form for creating a new Coordination Hour.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $periods = Period::all();
        $campus = Campus::all();

        return view('backend.coordination-hour.create', compact('periods', 'campus'));
    }

    /**
     * Store a newly created Coordination Hour in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        CoordinationHour::create($requestData);

        return redirect()->route('hour.index');
    }

    /**
     * Store a newly created Coordination Hour in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function task_period_store(Request $request)
    {
        $params = $request->all();
        $tasks = $params['tasks'];
        $coordination_hour = $params['coordination_hour'];

        foreach ($tasks as $task) {
            $hours = $params['hour' . $task];
            $users = $params['users' . $task];
            $amount = count($users);

            if($amount > 0) {
                foreach ($users as $user) {
                    TaskPeriod::create([
                        "hours" => intval($hours/$amount),
                        "user_id" => $user,
                        "task_id" => $task,
                        "coordination_hour_id" => $coordination_hour,
                    ]);
                }
            }
        }

        return redirect()->route('hour.distribution');
    }

    /**
     * Display the Coordination Hours.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coordination_hour = CoordinationHour::findOrFail($id);
        
        return view('backend.coordination-hour.show', compact('coordination_hour'));
    }

    /**
     * Show the form for editing the Coordination Hours.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coordination_hour = CoordinationHour::findOrFail($id);
        $periods = Period::all();
        $campus = Campus::all();
        
        return view('backend.coordination-hour.edit', compact('coordination_hour', 'periods', 'campus'));
    }

    /**
     * Update the Coordination Hours in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $coordination_hour = CoordinationHour::findOrFail($id);
        $coordination_hour->update($requestData);
        
        return redirect()->route('hour.index');
    }

    /**
     * Remove the Coordination Hours from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        CoordinationHour::destroy($id);
        
        return redirect()->route('hour.index');
    }
}
