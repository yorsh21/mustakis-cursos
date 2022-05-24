<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Storage;
use Session;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commune;
use App\Models\Course;
use App\Models\DivisionUser;
use App\Models\Grade;
use App\Models\Campus;
use App\Models\Solicitude;
use App\Models\Postulation;
use App\Models\SchoolWorkshop;
use App\Models\User;
use App\Models\Rol;
use App\Models\Survey;
use App\Models\Questionary;
use App\Models\Answer;
use App\Models\Parameter;
use App\Mail\RequestEmail;
use Carbon\Carbon;

class RequestController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Request.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $date_current = Carbon::now();

        if (Auth::user()->rol_id == Rol::ADMIN) 
        {
            $solicitudes = Solicitude::where('closed', false)->get();
            $campus = Campus::all()->pluck('commune_id')->toArray();

            return view('backend.request.index', compact('solicitudes', 'campus'));
        } 
        else if (Auth::user()->rol_id == Rol::COORDINADOR) 
        {
            $solicitudes = Solicitude::where('closed', false)->get();
            $campus = Campus::where('user_id', Auth::user()->id)->pluck('commune_id')->toArray();

            return view('backend.request.index', compact('solicitudes', 'campus'));
        } 
        else {
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the Request for Students.
     *
     * @return \Illuminate\View\View
     */
    public function postulation()
    {
        $user = Auth::user();
        $date_current = Carbon::now();

        if ($user->rol_id == Rol::ALUMNO) 
        {
            $postulations = Postulation::where([
                ['start_date', '<=', $date_current],
                ['end_date', '>=', $date_current]
            ])->get();

            $attended = collect();
            $user->division_users()->each(function($division_user, $value) use($attended) {
                if(isset($attended[$division_user->grade->school_workshop->id])) {
                    $attended[$division_user->grade->school_workshop->id] = max($attended[$division_user->grade->school_workshop->id], $division_user->approve);
                }
                else {
                    $attended[$division_user->grade->school_workshop->id] = $division_user->approve;
                }
            });

            $fill_full = $user->is_fill_profile;

            $solicitudes = Solicitude::where('user_id', $user->id)->get();
            return view('backend.request.postulation', compact('postulations', 'solicitudes', 'attended', 'fill_full'));
        } 
        else {
            return redirect()->back();
        }
    }


    /**
     * Show the form for creating a new Request.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created Request in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $postulation = Postulation::find($request->postulation_id);
        $count = Solicitude::where([
            ['user_id', Auth::user()->id],
            ['closed', false],
            ['created_at', '>=', $postulation->start_date],
            ['created_at', '<=', $postulation->end_date]
        ])->count();

        if ($count == 0) {
            Solicitude::create([
                'status' => Solicitude::PENDING,
                'user_id' => Auth::user()->id,
                'postulation_id' => $request->postulation_id,
            ]);

            Session::flash('message', ['success', 'Solicitud enviada exitosamente. Se te notificará por correo electrónico el resultado de la postulación.']);
            return redirect()->route('request.postulation');
        } else {
            Answer::where([
                ['user_id', Auth::user()->id],
                ['postulation_id', intval($request->postulation_id)]
            ])->each(function($answer) {
                $answer->delete();
            });

            Session::flash('message', ['danger', 'No puedes inscribirte a más de un taller por período.']);
            return redirect()->route('request.postulation');
        }
    }


    /**
     * Display the Request.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($request_id)
    {
        $request = Solicitude::findOrFail($request_id);
        return view('backend.request.show', compact('request'));
    }

    /**
     * Show the form for editing the Request.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $request = Solicitude::findOrFail($id);
        return view('backend.request.edit', compact('request'));
    }

    /**
     * Update the Request in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function update(Request $request, $id)
    {
        $solicitude = Solicitude::findOrFail($id);
        if ($solicitude != null) {
            $solicitude->status = $request->status;
            $solicitude->save();
        }
        return response()->json(['status' => $solicitude->status]);
    }


    /**
     * Remove the Request from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if (Auth::user()->rol_id == Rol::ADMIN) {
            $solicitude = Solicitude::find($id);

            Answer::where([
                ['user_id', $solicitude->user_id],
                ['postulation_id', $solicitude->postulation_id]
            ])->each(function($answer) {
                $answer->delete();
            });

            $solicitude->delete();

            return redirect()->route('request.index');
        } 
        elseif (Auth::user()->rol_id == Rol::ALUMNO) {
            Solicitude::where([
                ['user_id', Auth::user()->id],
                ['closed', false],
                ['postulation_id', $id]
            ])->each(function($solicitude) {
                $solicitude->delete();
            });

            Answer::where([
                ['user_id', Auth::user()->id],
                ['postulation_id', intval($id)]
            ])->each(function($answer) {
                $answer->delete();
            });

            return redirect()->back();
        } 
        else {
            return redirect()->back();
        }
    }

    /**
     * Get Request of the a Student.
     *
     * @param  int $postulation_id
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function store_request_student($postulation_id)
    {
        $id_request = Solicitude::get(['id'])->last();
        
        Solicitude::create([
            'status' => Solicitude::PENDING,
            'user_id' => Auth::user()->id,
            'postulation_id' => $postulation_id,
            'created_at' => Carbon::now(),
            'update_at' => null,
        ]);

        return redirect()->route('request.index');

    }

    /**
     * Get Request of the an active Student.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_request_student_active()
    {
        $request = User::find(Auth::user()->id)->solicitudes->where('status', Solicitude::PENDING);

        return $request;
    }

    /**
     * Get Postulation of the a Student.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_postulation_student_selected($request)
    {
        $request = DB::table('postulations')
                    ->select('solicitudes.id', 'school_workshops.name as school_name', 'school_workshops.description as school_description', 'periods.name as period_name', 'periods.description as period_description')
                    ->join('school_workshops', 'postulations.school_workshop_id', 'school_workshops.id')
                    ->leftjoin('periods', 'postulations.period_id', 'periods.id')
                    ->join('solicitudes', 'solicitudes.postulation_id', 'postulations.id')
                    ->where('solicitudes.id', $request->id)
                    ->get();

        return $request;
    }

    /**
     * Get the Request that are valid.
     *
     * @return \Illuminate\Support\Collection
     */
    public function validate_before_request()
    {
        $request = DB::table('solicitudes')
                    ->select('solicitudes.id')
                    ->where([
                        ['user_id', Auth::user()->id],
                        ['status', Solicitude::PENDING]
                    ])
                    ->get();

        return $request;
    }

    /**
     * Get the Request that are approved.
     *
     * @return \Illuminate\Support\Collection
     */
    public function validate_request_approved()
    {
        $request = DB::table('solicitudes')->select('solicitudes.id')->join('postulations', 'postulations.id', 'solicitudes.postulation_id')->join('periods', 'periods.id', 'postulations.period_id')->where('user_id', Auth::user()->id)->where('status', Solicitude::APPROVED)->get();

        return $request;
    }

    /**
     * Remove the Postulation that are allows.
     *
     * @return \Illuminate\Support\Collection
     */
    public function postulations_allows()
    {
        $date_current = Carbon::now();
        $request = DB::table('postulations')
            ->select('postulations.id', 'school_workshops.name as school_name',
                'school_workshops.description as school_description', 'periods.name as period_name',
                'periods.description as period_description')
            ->join('school_workshops', 'postulations.school_workshop_id', 'school_workshops.id')
            ->leftjoin('periods', 'postulations.period_id', 'periods.id')
            ->where('postulations.start_date', '<', $date_current)->where('postulations.end_date', '>', $date_current)->get();

        return $request;
    }

    /**
     * Remove the Request that are allows.
     *
     * @return \Illuminate\Support\Collection
     */
    public function requests_allows()
    {
        $request = DB::table('users')
            ->select('solicitudes.id', 'school_workshops.name as school_name',
                'school_workshops.description as school_description', 'periods.name as period_name',
                'users.firstname as firstname', 'users.lastname as lastname')
            ->join('solicitudes', 'solicitudes.user_id', 'users.id')
            ->leftjoin('postulations', 'postulations.id', 'solicitudes.postulation_id')
            ->leftjoin('school_workshops', 'school_workshops.id', 'postulations.school_workshop_id')
            ->leftjoin('periods', 'periods.id', 'postulations.period_id')
            ->where('status', Solicitude::PENDING)->get();

        return $request;
    }

    /**
     * Download Request that are closed or open.
     *
     * @param int $old
     *
     * @return \Illuminate\View\View
     */
    public function download_request($old = null) 
    {
        $solicitudes = Solicitude::where('closed', !is_null($old))->get();
        $answer_keys = [];

        $keys = $solicitudes->mapToGroups(function($item) {
            return [$item->postulation_id => $item->id];
        })->keys();
        $answers = Answer::whereIn('postulation_id', $keys)->get();

        foreach ($solicitudes as $key => $solicitude) {
            foreach ($answers as $key2 => $answer) {
                if($answer->user_id == $solicitude->user_id) {
                    $answ = $answer->answers;
                    unset($answ["_token"]); 

                    if(is_null($solicitudes[$key]->answers)) {
                        $solicitudes[$key]->answers = $answ;
                    }
                    else {
                        $solicitudes[$key]->answers = array_merge($solicitudes[$key]->answers, $answ);
                    }

                    foreach ($answ as $k => $v) {
                        $answer_keys[$k] = $k;
                    }
                }
            }
        }

        return view('backend.request.download', compact('solicitudes', 'answers', 'answer_keys'));
    }

    /**
     * Send masive email to confirm Request.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send_confirm_request() 
    {
        if (Auth::user()->rol_id == Rol::ADMIN) 
        {
            $email_aprobado = Parameter::where('key', 'email_aprobado')->first()->value;
            $email_rechazado = Parameter::where('key', 'email_rechazado')->first()->value;

            $solicitudes = Solicitude::where('closed', false)->get();
            foreach ($solicitudes as $solicitude) {
                if($solicitude->status == Solicitude::APPROVED){
                    $data = [$solicitude->user->firstname, $email_aprobado];
                    Mail::to($solicitude->user->email)->send(new RequestEmail($data));
                }
                elseif($solicitude->status == Solicitude::PENDING){
                    $data = [$solicitude->user->firstname, $email_rechazado];
                    Mail::to($solicitude->user->email)->send(new RequestEmail($data));
                }

                $solicitude->closed = true;
                $solicitude->save();
            }

            session()->flash('status', 'Correos de postulaciones enviados correctamente');
            return redirect()->route('request.index'); 
        } 
        else 
        {
            return redirect()->back(); 
        }
    }

    /**
     * Get index to historical Request.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index_historicos() {
        if (Auth::user()->rol_id == Rol::ADMIN) 
        {
            $solicitudes = Solicitude::where('closed', true)->get();
            return view('backend.request.historical', compact('solicitudes'));
        } 
        else 
        {
            return redirect()->back(); 
        }
    }

    /**
     * List Surveys for previous Request.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function surveys(Request $request) 
    {
        if (Auth::user()->rol_id == Rol::ALUMNO) 
        {
            $postulation = Postulation::find($request->postulation_id);
            $survey = Survey::find($postulation->survey_id);

            if (is_null($survey->questionnaires)) {
                $questionnaires = [];
            }
            else {
                $questionnaires = Questionary::whereIn("_id", $survey->questionnaires)->get();
            }

            return view('backend.request.surveys', compact('postulation', 'survey', 'questionnaires'));
        } 
        else 
        {
            return redirect()->back(); 
        }
    }

    /**
     * List Surveys for previous Request.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function survey(Request $request, $questionary_id, $postulation_id) 
    {
        $questionary = Questionary::find($questionary_id)->toArray();
        
        $answerData = [
            'answers' => $request->all(),
            'questionary' => $questionary,
            'user_id' => Auth::user()->id,
            'postulation_id' => intval($postulation_id),
        ];

        Answer::create($answerData);

        return response()->json(['status' => 1]);
    }
    
    /**
     * Return filled documents.
     *
     * @param int $user_id
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function fill_documents($user_id) {
        return response()->json(["fill" => User::find($user_id)->is_fill_documentacion_data]);
    }

    /**
     * Show Answers from request surveys.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function request_answers($postulation_id, $user_id) 
    {
        $answers = Answer::where([
            ['postulation_id', intval($postulation_id)],
            ['user_id', intval($user_id)]
        ])->get();

        return view('backend.request.answer', compact('answers'));
    }
}
