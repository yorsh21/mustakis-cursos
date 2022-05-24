<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Room.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.index');
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.room.create');
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return \Illuminate\View\View
     */
    public function create_from_campus($campus_id)
    {
        return view('backend.room.create', compact('campus_id'));
    }

    /**
     * Store a newly created Room in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Room::create($requestData);
        $url = session('current_path_campus') . ".show";

        return redirect()->route($url, session('current_item_campus'));
    }

    /**
     * Display the Room.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);

        return view('backend.room.show', compact('room'));
    }

    /**
     * Show the form for editing the Room.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);

        return view('backend.room.edit', compact('room'));
    }

    /**
     * Update the Room in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $room = Room::findOrFail($id);
        $room->update($requestData);
        $url = session('current_path_campus') . ".show";

        return redirect()->route($url, session('current_item_campus'));
    }

    /**
     * Remove the Room from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $campus = Room::find($id);
        Room::destroy($id);

        return redirect()-> route('campus.show', $campus->campus_id);

    }
}
