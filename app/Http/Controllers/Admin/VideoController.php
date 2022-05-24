<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoComment;
use App\Models\User;
use App\Models\Rol;
use App\Models\Event;
use Carbon\Carbon;

class VideoController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Video.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::ASESOR ) {
            $videos = Video::all();
        }
        else if(Auth::user()->rol_id == Rol::PROFESOR) {
            $videos = Video::where('user_id', Auth::user()->id)->get();
        }
        else {
            return redirect()->back();
        }
        
        return view('backend.video.index')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new Video.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::user()->id;

        return view('backend.video.create')->with('user_id', $user_id);
    }

    /**
     * Display the Video.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);

        return view('backend.video.show', compact('video'));
    }

    /**
     * Show the form for editing the Video.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $user_id = Auth::user()->id;

        return view('backend.video.edit', compact('video', 'user_id'));
    }

    /**
     * Show the form for editing the Video.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        
        if(Video::create($requestData)) {
            $asesores = User::where('rol_id', Rol::ASESOR)->orWhere('multiroles', Rol::ASESOR)->get();
    
            foreach ($asesores as $asesor) {
                Event::create([
                    'title' => Auth::user()->short_first_name . " ha publicado un nuevo video",
                    'content' => $requestData['title'],
                    'url' => route('video.index'),
                    'image' => asset(Auth::user()->image),
                    'viewed' => false,
                    'datetime' => Carbon::now(),
                    'user_id' => $asesor->id
                ]);
            }
        }


        return redirect()->route('video.index');
    }

    /**
     * Update the Video in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $video = Video::findOrFail($id);
        $video->update($requestData);

        return redirect()->route('video.index');
    }

    /**
     * Remove the Video from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Video::destroy($id);

        return redirect()->route('video.index');
    }

    /**
     * Comment a specific Video.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function comment(Request $request)
    {
        $requestData = $request->all();
        $requestData["user_id"] = Auth::user()->id;

        if (VideoComment::create($requestData)) {
            $video = Video::findOrFail($requestData["video_id"]);

            if(Auth::user()->id != $video->user_id) {
                Event::create([
                    'title' => Auth::user()->short_first_name . " ha comentado el video " . $video->title,
                    'content' => $requestData["comments"],
                    'url' => route('video.index'),
                    'image' => asset(Auth::user()->image),
                    'viewed' => false,
                    'datetime' => Carbon::now(),
                    'user_id' => $video->user_id
                ]);
            }
            else {
                $users = $video->video_comments->pluck('user_id')->unique();

                foreach ($users as $user) {
                    if(Auth::user()->id != $user) {
                        Event::create([
                            'title' => Auth::user()->short_first_name . " ha comentado el video " . $video->title,
                            'content' => $requestData["comments"],
                            'url' => route('video.index'),
                            'image' => asset(Auth::user()->image),
                            'viewed' => false,
                            'datetime' => Carbon::now(),
                            'user_id' => $user
                        ]);
                    }
                }
            }
            
        }

        return redirect()->route('video.index');
    }

}
    