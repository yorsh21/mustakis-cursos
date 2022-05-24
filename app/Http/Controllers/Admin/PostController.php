<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Input;
use Session;
use Storage;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DivisionUser;
use App\Models\Grade;
use App\Models\Post;
use App\Models\User;
use App\Models\Rol;
use App\Models\Event;
use Carbon\Carbon;
use App\Mail\PostEmail;

class PostController extends Controller
{
    const NOTICE = 'notice';
    const CONSULT = 'consult';
    const COMMENT = 'comment';

    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $grade_id = request()->grade_id;

        return view('backend.post.index', compact('grade_id'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function grades($id)
    {
        $grades = DB::select("select g.id from grades g inner join division_users d on d.grade_id = g.id where g.id = '$id' and d.user_id =" . Auth::user()->id);
        if ($grades == null) {
            return redirect()->back();
        }

        Session::forget('grade');
        Session::forget('data_announcement');

        $posts = Post::find($id);
        if ($posts == null) {
            $posts = $id;
        }

        return view('backend.post.index', compact('posts'));
    }

    public function load_index()
    {
        $grade_id = request()->grade_id;
        return view('backend.post.index', compact('grade_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($forum)
    {
        if(Auth::user()->if_mute)
            return redirect()->back();
        
        $grade = Session::get('grade');
        if ($grade == null) {
            return redirect()->back();
        }

        if ($forum == $this::CONSULT && Auth::user()->rol_id == Rol::PROFESOR || Auth::user()->rol_id == Rol::VOLUNTARIO) {
            return redirect()->back();
        }
        if ($forum == $this::NOTICE && Auth::user()->rol_id == Rol::ALUMNO || Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::COORDINADOR) {
            return redirect()->back();
        }

        //$forum se obtendra de los botones de 'Responder' y 'Crear Anuncio' respectivamente
        if ($forum == null) {
            return redirect()->route('grade.index');
        }
        //Notice es el valor que contiene 'Crear Anuncio' Comment es el valor que contiene 'Responder'
        if ($forum != $this::NOTICE && $forum != $this::CONSULT && $forum != $this::COMMENT) {
            return redirect()->back();
        }
        //si la session existe en caso de no exister quiere decir quiere decir que el usuario no paso a traves del flujo normal del sistema
        $data_announcement = Session::get('data_announcement');
        if ($forum == $this::COMMENT) {
            if ($data_announcement == null) {
                return redirect()->back();
            }
        }

        $type_forum = $forum;
        return view('backend.post.create', compact('type_forum', 'grade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        
        $data = request()->validate([
            'asunto' => 'required|max:250',
            'mensaje' => 'required|max:12000',
            'file' => 'file|mimes:pdf,jpeg,png,docx,doc,xlsx,xls,ppt,pptx,txt,ino|max:5000',
        ]);

        $file = $request->file('file');
        if ($file != null) {
            $file_hash = Storage::disk('pdf')->put('', $file);
            $file_name = $file->getClientOriginalName();
        }
        else {
            $file_hash = null;
            $file_name = '';
        }

        //Se comprueba si se quiere crear un nuevo Anuncio
        if ($requestData['type_forum'] == $this::NOTICE) {

            $grade = Session::get('grade');
            if ($grade->archived) {
                return back();
            }

            $division_user = User::find(Auth::user()->id)->division_users->where('grade_id', $grade->id)->first();

            $create = Post::create([
                'title' => $requestData['asunto'],
                'body' => $requestData['mensaje'],
                'division_user_id' => $division_user->id,
                'creation_date' => Carbon::now(),
                'updated_date' => null,
                'grade_id' => $division_user->grade_id,
                'forum' => 'anuncio',
                'name' => $file_name,
                'file' => $file_hash,
                'parent_id' => null
            ]);

            $students = $grade->division_users->filter(function ($value, $key) use($grade) {
                return $value->grade_id == $grade->id && $value->user->rol_id == Rol::ALUMNO;
            });

            foreach ($students as $student) {
                Mail::to($student->user)->send(new PostEmail($student));
                Event::create([
                    'title' => Auth::user()->short_first_name . " ha publicado en el foro de " . $division_user->grade->school_workshop->name,
                    'content' => $create->title,
                    'url' => route('post.show', $create->id),
                    'image' => asset(Auth::user()->image),
                    'viewed' => false,
                    'datetime' => Carbon::now(),
                    'user_id' => $student->user->id
                ]);
            }
            
            Session::forget('data_announcement');
            return redirect()->route('back.view', [$division_user->grade_id, 'anuncio']);
        } 
        elseif ($requestData['type_forum'] == $this::CONSULT) {

            $grade = Session::get('grade');
            if ($grade->archived) {
                return redirect()->back();
            }
            
            $division_user = User::find(Auth::user()->id)->division_users->where('grade_id', $grade->id)->first();

            $create = Post::create([
                'title' => $requestData['asunto'],
                'body' => $requestData['mensaje'],
                'division_user_id' => $division_user->id,
                'creation_date' => Carbon::now(),
                'updated_date' => null,
                'grade_id' => $division_user->grade_id,
                'forum' => 'consulta',
                'name' => $file_name,
                'file' => $file_hash,
                'parent_id' => null
            ]);

            $teachers = $grade->division_users->filter(function ($value, $key) use($grade) {
                return $value->grade_id == $grade->id && $value->user->rol_id == Rol::PROFESOR;
            });

            foreach ($teachers as $teacher) {
                Mail::to($teacher->user)->send(new PostEmail($teacher));
                Event::create([
                    'title' => Auth::user()->short_first_name . " ha publicado en el foro de " . $division_user->grade->school_workshop->name,
                    'content' => $create->title,
                    'url' => route('post.show', $create->id),
                    'image' => asset(Auth::user()->image),
                    'viewed' => false,
                    'datetime' => Carbon::now(),
                    'user_id' => $teacher->user->id
                ]);
            }

            return redirect()->route('back.view', [$division_user->grade_id, 'consulta']);
        }
        elseif ($requestData['type_forum'] == $this::COMMENT) {
            $data_announcement = Session::get('data_announcement');
            $grade = Grade::find($data_announcement[2]);
            if ($grade->archived) {
                return back();
            }

            $create = Post::create([
                'title' => $requestData['asunto'],
                'body' => $requestData['mensaje'],
                'division_user_id' => $data_announcement[1],
                'creation_date' => Carbon::now(),
                'updated_date' => null,
                'grade_id' => $data_announcement[2],
                'forum' => $data_announcement[3],
                'name' => $file_name,
                'file' => $file_hash,
                'parent_id' => $data_announcement[0]
            ]);

            $users = $grade->division_users->filter(function ($value, $key) use($grade) {
                return $value->grade_id == $grade->id;
            });

            foreach ($users as $user) {
                if(Auth::user()->id != $user->user->id) {
                    Mail::to($user->user)->send(new PostEmail($user));
                    Event::create([
                        'title' => Auth::user()->short_first_name . " ha publicado en el foro de " . $grade->school_workshop->name,
                        'content' => $create->title,
                        'url' => route('post.show', $data_announcement[0]),
                        'image' => asset(Auth::user()->image),
                        'viewed' => false,
                        'datetime' => Carbon::now(),
                        'user_id' => $user->user->id
                    ]);
                }
            }

            Session::forget('data_announcement');
            return $this->show($data_announcement[0]);
        }
    }

    /**
     * Display the Post.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id_announcement)
    {
        $announcement = Post::where('parent_id', null)->where('id', $id_announcement)->first();
        if (is_null($announcement) && count($announcement) == 0) {
            return redirect()->back();
        }

        $status_view_post = Post::find($id_announcement)->grade->division_users->where('user_id', Auth::user()->id);
        if ($status_view_post == null) {
            return back();
        }

        $mute = Auth::user()->text_mute;
        $if_mute = Auth::user()->if_mute;
        $posts = Post::where('id', $id_announcement)->orWhere('parent_id', $id_announcement)->get();
        $data_student = Grade::find($announcement->grade_id)->division_users->where('user_id', Auth::user()->id)->first();
        $status_grade = $announcement->grade->end_date < Carbon::now()->format('Y-m-d');
        $flow_comment = 1;

        if (is_null($data_student))
            $data_announcement = [$announcement->id, 0, $announcement->grade_id, $announcement->forum];
        else
            $data_announcement = [$announcement->id, $data_student->id, $announcement->grade_id, $announcement->forum];
        
        Session::put('data_announcement', $data_announcement);
        Session::put('flow_comment', $flow_comment);

        return view('backend.post.show', compact('posts', 'status_grade', 'mute', 'if_mute'));
    }

    /**
     * Show the form for editing the Post.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('backend.post.edit', compact('post'));
    }

    /**
     * Update the Post in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $post = Post::findOrFail($id);
        $post->update($requestData);

        return redirect('/post');
    }

    /**
     * Remove the Post from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, $grade)
    {
        Post::destroy($id);

        return redirect()->route('grade.view', $grade);
    }

    /**
     * Load announcements page.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function announcement(Request $request)
    {
        $posts = Post::where([
            ['grade_id', $request->id],
            ['parent_id', null],
            ['forum', 'anuncio']
        ])->get();

        $arreglo = array();
        $i = 0;

        foreach ($posts as $post) {
            $last_message = $post->childs->sortByDesc('created_at')->first();
            if(is_null($last_message))
                $last_date = null;
            else
                $last_date = $last_message->created_at->format('d/m/Y h:i');

            $arreglo[$i] = $post->division_user->user;
            $arreglo[$i]['id_mensaje'] = $post->id;
            $arreglo[$i]['mensaje'] = $post->title;
            $arreglo[$i]['fecha_anuncio_creado'] = $post->first();
            $arreglo[$i]['comentarios'] = $post->childs->count();
            $arreglo[$i]['fecha_ultimo_mensaje'] = $last_date;
            $arreglo[$i]['nombre_usuario_ultimo_mensaje'] = DivisionUser::with('user')
                ->where('division_users.id', $last_message['division_user_id'])->first();
            $i++;
        }
        return $arreglo;
    }

    /**
     * Load consult page.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function consult(Request $request)
    {
        $grade_id = $request->id;

        $posts = Post::all()
            ->where('grade_id', $grade_id)
            ->where('parent_id', null)
            ->where('forum', 'consulta');

        $arreglo = array();
        $i = 0;

        foreach ($posts as $post) {
            $arreglo[$i] = $post->division_user->user;
            $arreglo[$i]['id_mensaje'] = $post->id;
            $arreglo[$i]['mensaje'] = $post->title;
            $arreglo[$i]['fecha_anuncio_creado'] = $post->first();
            $arreglo[$i]['comentarios'] = $post->childs->count();
            $arreglo[$i]['fecha_ultimo_mensaje'] = $post->childs->sortByDesc('created_at')->first();
            $arreglo[$i]['nombre_usuario_ultimo_mensaje'] = DivisionUser::with('user')
                ->where('division_users.id', $arreglo[$i]['fecha_ultimo_mensaje']['division_user_id'])->first();
            $i++;
        }
        return $arreglo;
    }

    /**
     * Download a specific file in Post.
     *
     * @param  int $id_post
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function download($id_post)
    {
        $post = Post::findOrFail($id_post);

        if(!is_null($post) && !is_null($post->file) && is_file(public_path('pdf/') . $post->file)) {
            return \Response::download(public_path('pdf/') . $post->file, $post->name);
        }
        else {
            return redirect()->back();
        }
    }

}
