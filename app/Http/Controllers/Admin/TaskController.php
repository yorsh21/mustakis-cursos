<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Task;
use App\Models\TaskPeriod;
use App\Models\Period;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Task.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tasks = Task::all();

        return view('backend.task.index', compact('tasks'));
    }

    /**
     * Display a listing of the Task.
     *
     * @return \Illuminate\View\View
     */
    public function asignacion(Request $request)
    {

        $task_periods = TaskPeriod::where("user_id", Auth::user()->id)->get();

        return view('backend.task.asignacion', compact('task_periods'));
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.task.create');
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Task::create($requestData);

        return redirect()->route('task.index');
    }

    /**
     * Display the Task.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        return view('backend.task.show', compact('task'));
    }

    /**
     * Show the form for editing the Task.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        return view('backend.task.edit', compact('task'));
    }

    /**
     * Update the Task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $task = Task::findOrFail($id);
        $task->update($requestData);
        
        return redirect()->route('task.index');
    }

    /**
     * Remove the Task from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Task::destroy($id);
        
        return redirect()->route('task.index');
    }
}
