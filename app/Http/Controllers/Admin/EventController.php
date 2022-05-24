<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Events.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $events = Event::where("user_id", Auth::user()->id)->orderby("id", "DESC")->get();

        return view('backend.event.index', compact('events'));
    }

    /**
     * Display a listing of the Events for particular user.
     *
     * @return \Illuminate\View\View
     */
    public function fetch(Request $request)
    {
        if($request->ajax()) {
            $events = Event::where("user_id", Auth::user()->id)->orderby("id", "DESC")->get();
            
            return response()->json(['events' => $events, 'user' => Auth::user()->id]);
        }
        else {
            return redirect()->route('sumary');
        }
    }

    /**
     * Display a listing of the Events.
     *
     * @return \Illuminate\View\View
     */
    public function viewed(Request $request, $id)
    {
        if($request->ajax()) {
            $event = Event::find($id);
            $event->viewed = true;
            $event->save();
            
            return response()->json(['viewed' => 1]);
        }
        else {
            return redirect()->route('sumary');
        }
    }

    /**
     * Display the Event.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = Event::find($id);
        $event->viewed = true;
        $event->save();

        return redirect()->to($event->url);
    }

    /**
     * Remove the Event from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Event::destroy($id);

        return redirect()->route('event.index');
    }


    /**
     * Remove the Event from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy_all()
    {
        Event::where("user_id", Auth::user()->id)->each(function ($item, $key) {
            $item->delete();
        });

        return redirect()->route('event.index');
    }
}
