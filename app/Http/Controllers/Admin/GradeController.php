<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\BlockGrade;
use App\Models\BlockGradeUser;
use App\Models\SchoolWorkshopsCampus;
use App\Models\Period;
use App\Models\Campus;
use App\Models\Commune;
use App\Models\Room;
use App\Models\Block;
use App\Models\User;
use App\Models\Rol;
use App\Models\SchoolWorkshop;
use App\Models\DivisionUser;
use App\Models\Questionary;
use App\Models\Answer;
use App\Models\Milestone;
use Carbon\Carbon;

class GradeController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Grades.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (Auth::user()->rol_id == Rol::ADMIN) 
        {
            $grades = Grade::where('archived', false)->get();
            $periods = Period::all();

            return view('backend.grade.index', compact('grades', 'periods'));
        }
        elseif (Auth::user()->rol_id == Rol::COORDINADOR) 
        {
            $region = Auth::user()->commune->region->id;
            $periods = Period::all();

            $grades = Grade::where('archived', false)->get()->filter(function($grade, $key) use($region) {
                return $grade->campus->commune->region->id == $region;
            });

            return view('backend.grade.index', compact('grades', 'periods'));
        }
        else
        {
            Session::forget('grade');
            Session::forget('data_announcement');

            $divisions = DivisionUser::where('user_id', Auth::user()->id)->pluck('grade_id');
            $grades = Grade::find($divisions)->reverse();

            return view('backend.grade.index', compact('grades'));
        }
    }

    /**
     * Display a listing of the Grade.
     *
     * @return \Illuminate\View\View
     */
    public function archived($period_id)
    {
        if (Auth::user()->rol_id == Rol::ADMIN) 
        {
            if($period_id == 0) 
                $grade = Grade::where('archived', true)->get();
            else 
                $grade = Grade::where('period_id', $period_id)->get();

            $periods = Period::all();
            $period = Period::find($period_id);
            return view('backend.grade.archived', compact('grade', 'period', 'periods'));
        }
        elseif (Auth::user()->rol_id == Rol::COORDINADOR) {
            $region = Auth::user()->commune->region->id;

            $grade = Grade::where('archived', true)->get()->filter(function($grade, $key) use($region) {
                return $grade->campus->commune->region->id == $region;
            });
            
            $periods = Period::all();
            $period = Period::find($period_id);
            return view('backend.grade.archived', compact('grade', 'period', 'periods'));
        }
        else
        {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new Grade.
     *
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $grade = Grade::findOrFail($id);
        $milestones = Milestone::where('grade_id', $id)->get();
        $questionnaires = Questionary::all()->pluck('name', '_id');
        $division_users = DivisionUser::where('grade_id', $id)->get();
        
        if (Auth::user()->rol_id == Rol::ALUMNO) {
            $division_user = DivisionUser::where([
                ['grade_id', $id],
                ['user_id', Auth::user()->id]
            ])->first()->id;
            $block_grade_users = BlockGradeUser::where('division_user_id', $division_user)->orderBy('block_grade_id', 'asc')->get();
        }
        else {
            $block_grade_users = null;
        }
        Session::forget('data_announcement');
        Session::put('grade', $grade);
        Session::forget('flow_comment');

        $select_view = Session::get('select_view');

        if ($select_view == 'consulta' || $select_view == 'anuncio' || $select_view == 'notas') {
            Session::forget('select_view');
            return view('backend.grade.view')
                ->with('grade', $grade)
                ->with('division_users', $division_users)
                ->with('block_grade_users', $block_grade_users)
                ->with('questionnaires', $questionnaires)
                ->with('milestones', $milestones)
                ->with('select_view', $select_view);
        }
        else {
            return view('backend.grade.view')
                ->with('block_grade_users', $block_grade_users)
                ->with('grade', $grade)
                ->with('questionnaires', $questionnaires)
                ->with('milestones', $milestones)
                ->with('division_users', $division_users);
        }
    }

    public function back_view($id_grade, $type_back_view)
    {
        Session::put('select_view', $type_back_view);
        return redirect()->route('grade.view', $id_grade);
    }

    /**
     * Show the form for creating a new Grade.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $schoolworkshops = SchoolWorkshop::all();
        $periods = Period::all();
        $campus = Campus::all();

        return view('backend.grade.create')
            ->with('schoolworkshops', $schoolworkshops)
            ->with('periods', $periods)
            ->with('campus', $campus);
    }

    /**
     * Store a newly created Grade in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $grade = Grade::create($requestData);

        foreach ($grade->school_workshop->blocks as $block) {
            $block_grade = new BlockGrade;
            $block_grade->block_id = $block->id;
            $block_grade->grade_id = $grade->id;
            $block_grade->save();
        }

        return redirect()->route('grade.blocks', $grade->id);
    }

    /**
     * Display the Grade.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $grade = Grade::findOrFail($id);

        if (Auth::user()->rol_id == Rol::ADMIN) {
            return view('backend.grade.show', compact('grade'));
        }
        elseif (Auth::user()->rol_id == Rol::COORDINADOR && $grade->campus->commune->region->id == Auth::user()->commune->region->id)  {
            return view('backend.grade.show', compact('grade'));
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the Grade.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(Auth::user()->rol_id == Rol::ADMIN){
            $grade = Grade::findOrFail($id);
            $schoolworkshops = SchoolWorkshop::all();
            $periods = Period::all();
            $campus = Campus::all();

            return view('backend.grade.edit')
                ->with('grade', $grade)
                ->with('campus', $campus)
                ->with('schoolworkshops', $schoolworkshops)
                ->with('periods', $periods);
        }
        elseif (Auth::user()->rol_id == Rol::COORDINADOR) {
            $grade = Grade::findOrFail($id);
            
            if($grade->campus->commune_id == Auth::user()->city_assist_workshop) {
                $schoolworkshops = SchoolWorkshop::all();
                $periods = Period::all();
                $campus = Campus::all();

                return view('backend.grade.edit')
                    ->with('grade', $grade)
                    ->with('campus', $campus)
                    ->with('schoolworkshops', $schoolworkshops)
                    ->with('periods', $periods);
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Update the Grade in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $grade = Grade::findOrFail($id);

        if(!$grade->archived) {
            $grade->update($requestData);
            foreach ($grade->school_workshop->blocks as $block) {
                $count = BlockGrade::where([
                    ['block_id', $block->id], 
                    ['grade_id', $grade->id]
                ])->count();

                if($count == 0) {
                    $block_grade = new BlockGrade;
                    $block_grade->block_id = $block->id;
                    $block_grade->grade_id = $grade->id;
                    $block_grade->save();
                }
            }
        }

        return redirect()->route('grade.index');
    }

    /**
     * Remove the Grade from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Grade::destroy($id);
        return redirect()->route('grade.index');
    }

    /**
     * Load list of the Student for add to Grade.
     *
     * @param int $grade_id
     *
     * @return \Illuminate\View\View
     */
    public function grades_allow()
    {
        $grades = DB::select("select t.name ,g.start_date,g.end_date, u.firstname,u.lastname from users u inner join division_users d on u.id = d.user_id inner join grades g on g.id = d.grade_id inner join school_workshops t on t.id = g.school_workshop_id where d.user_id = " . Auth::user()->id);
        return $grades;
    }


    /**
     * Show the form for creating a new Block in Grade.
     *
     * @return \Illuminate\View\View
     */
    public function blocks($grade_id)
    {
        $grade = Grade::findOrFail($grade_id);
        $rooms = Room::where('campus_id', $grade->campus_id)->get();

        return view('backend.grade.blocks')
            ->with('rooms', $rooms)
            ->with('grade', $grade);
    }

    /**
     * Load list of the Teachers for add to Grade.
     *
     * @param int $grade_id
     *
     * @return \Illuminate\View\View
     */
    public function teachers($grade_id)
    {
        if(Auth::user()->rol_id == Rol::ADMIN){
            $grade = Grade::findOrFail($grade_id);
            $teachers = User::where('rol_id', Rol::PROFESOR)->orWhere('multiroles', Rol::PROFESOR)->get();

            return view('backend.grade.teachers')
                ->with('teachers', $teachers)
                ->with('rol', Rol::PROFESOR)
                ->with('grade', $grade);
        }
        elseif(Auth::user()->rol_id == Rol::COORDINADOR){
            $city = Commune::find(Auth::user()->city_assist_workshop)->region_id;
            $grade = Grade::findOrFail($grade_id);
            $teachers = collect();

            User::each(function($user, $key) use($teachers, $city) {
                if($user->has_rol(Rol::PROFESOR)  && ((!is_null($user->commune) && $user->commune->region_id == $city) || is_null($user->commune))) {
                    $teachers->push($user);
                }
            });

            return view('backend.grade.teachers')
                ->with('teachers', $teachers)
                ->with('rol', Rol::PROFESOR)
                ->with('grade', $grade);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Load list of the Volunteers for add to Grade.
     *
     * @param int $grade_id
     *
     * @return \Illuminate\View\View
     */
    public function volunteers($grade_id)
    {
        if(Auth::user()->rol_id == Rol::ADMIN){
            $grade = Grade::findOrFail($grade_id);
            $volunteers = User::where('rol_id', Rol::VOLUNTARIO)->orWhere('multiroles', Rol::VOLUNTARIO)->get();

            return view('backend.grade.volunteers')
                ->with('volunteers', $volunteers)
                ->with('rol', Rol::VOLUNTARIO)
                ->with('grade', $grade);
        }
        elseif(Auth::user()->rol_id == Rol::COORDINADOR){
            $city = Commune::find(Auth::user()->city_assist_workshop)->region_id;
            $grade = Grade::findOrFail($grade_id);
            $volunteers = collect();

            User::each(function($user, $key) use($volunteers, $city) {
                if($user->has_rol(Rol::VOLUNTARIO) && ((!is_null($user->commune) && $user->commune->region_id == $city) || is_null($user->commune))) {
                    $volunteers->push($user);
                }
            });

            return view('backend.grade.volunteers')
                ->with('volunteers', $volunteers)
                ->with('rol', Rol::VOLUNTARIO)
                ->with('grade', $grade);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Load list of the Student for add to Grade.
     *
     * @param int $grade_id
     *
     * @return \Illuminate\View\View
     */
    public function students($grade_id)
    {
        if (Auth::user()->rol_id == Rol::ADMIN) {
            $campus = Campus::all()->pluck('commune_id')->toArray();
        } 
        else if (Auth::user()->rol_id == Rol::COORDINADOR) {
            $campus = Campus::where('user_id', Auth::user()->id)->pluck('commune_id')->toArray();
        } 
        else {
            return redirect()->back();
        }

        $today = date('Y-m-d');
        $current_period = Period::where([
            ['start_date', '<=', $today],
            ['end_date', '>=', $today]
        ])->first();

        $grade = Grade::findOrFail($grade_id);
        $students = User::where('rol_id', Rol::ALUMNO)
            ->orWhere('multiroles', Rol::ALUMNO)
            ->whereIn('city_assist_workshop',  $campus)
            ->get()
            ->filter(function($user) use($current_period) {
                $approve = false;

                foreach ($user->solicitudes as $solicitude) {
                    if($solicitude->status == 'aprobada' && $solicitude->postulation->period->id == $current_period->id) {
                        $approve = true;
                        break;
                    }
                }

                return $approve;
            });
        
        return view('backend.grade.students')
            ->with('current_period', $current_period)
            ->with('students', $students)
            ->with('campus', $campus)
            ->with('rol', Rol::ALUMNO)
            ->with('grade', $grade);
    }

    /**
     * Finish Grade at end Period.
     *
     * @param int $grade_id
     *
     * @return \Illuminate\View\View
     */
    public function finish($grade_id) {
        $division_users = DivisionUser::where('grade_id', $grade_id)->get();
        $block_grades = BlockGrade::where('grade_id', $grade_id)->get();

        foreach ($division_users as $division_user) {
            if($division_user->rol == 3 || $division_user->rol == 4 || $division_user->rol == 5){
                foreach ($block_grades as $block_grade) {
                    $count = BlockGradeUser::where([
                        ['block_grade_id', $block_grade->id], 
                        ['division_user_id', $division_user->id]
                    ])->count();

                    if($count == 0) {
                        $new_block = new BlockGradeUser;
                        $new_block->block_grade_id = $block_grade->id;
                        $new_block->division_user_id = $division_user->id;
                        $new_block->save();
                    }
                }
            }
        }
        return redirect()->route('grade.show' , $grade_id);
    }

    /**
     * Load BlocksGradeUser of this Grade.
     *
     * @param Request $request
     *
     * @return @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function block_grade_user(Request $request) {
        $data = $request->all();

        if(isset($data["binnacle"])) {
            DivisionUser::find($data["division_user"])->update([
                "binnacle" => $data["binnacle"]
            ]);
        }

        for ($i = 0; $i < count($data["block_grades"]); $i++) { 
            $blockgradeuser = BlockGradeUser::where([
                ['block_grade_id', $data["block_grades"][$i]],
                ['division_user_id', $data["division_user"]],
            ])->first();

            if(isset($data["asistencias"][$i])) {
                $asistencia = 1;
            }
            else {
                $asistencia = 0;
            }

            $blockgradeuser->update([
                "presence" => $asistencia,
                "score" => $data["notas"][$i]
            ]);
        }

        if($request->ajax()) {
            return response()->json(['status' => $blockgradeuser->id, ]);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Download information of the Grades.
     *
     * @param int $period_id
     *
     * @return @return \Illuminate\View\View
     */
    public function download_info($period_id) {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $current_period = Period::find($period_id);

            if(is_null($current_period))
                return redirect()->back();

            $blocks = 0;
            $grades = Grade::where('period_id', $current_period->id)->get();
            $newgrades = [];
            foreach ($grades as $grade) {
                $blocks = max($blocks, $grade->block_grades->count());
                array_push($newgrades, $grade->update_open_courses());
            }

            return view('backend.grade.info')->with('blocks', $blocks)->with('grades', $newgrades);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Download Grade List of the Students.
     *
     * @param int $grade_id
     *
     * @return @return \Illuminate\View\View
     */
    public function download_list($grade_id) {
        if(Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::COORDINADOR || Auth::user()->rol_id == Rol::PROFESOR) {
            $grade = Grade::find($grade_id);
            $block = $grade->block_grades->count();

            return view('backend.grade.download')->with('block', $block)->with('grade', $grade);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Generate the sumary of this Grade.
     *
     * @param int $grade_id
     *
     * @return @return \Illuminate\View\View
     */
    public function sumary($grade_id) {
        if(Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::COORDINADOR) {
            $grade = Grade::find($grade_id);
            $blocks = $grade->block_grades->count();

            $newgrade = $grade->update_open_courses();
            
            return view('backend.grade.sumary')->with('blocks', $blocks)->with('grade', $newgrade);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Close Grade to end Period.
     *
     * @param Request $request
     *
     * @return @return \Illuminate\View\View
     */
    public function close(Request $request) {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $grade_id = $request->grade_id;
            $approves = json_decode($request->approves, true);

            $grade = Grade::find($grade_id);
            $blocks = $grade->block_grades->count();

            foreach($grade->division_users as $division_user) {
                $division_user->average_notes = 0;
                $division_user->attendance_percentage = 0;
                $division_user->approve = false;
                $weighing_counter = 0;

                foreach($grade->block_grades as $block){
                    foreach($block->block_grade_users as $block_grade_user) {
                        if ($block_grade_user->division_user_id == $division_user->id) {
                            $division_user->average_notes += $block_grade_user->score*$block->block->weighing; //Nota por Ponderación de dicha Sesión
                            $division_user->attendance_percentage += $block_grade_user->presence;
                        }
                    }
                    $weighing_counter += $block->block->weighing;
                }

                if($weighing_counter != 0) {
                    $division_user->average_notes = floor($division_user->average_notes/$weighing_counter);
                }

                if($blocks != 0) {
                    $division_user->attendance_percentage = floor($division_user->attendance_percentage/$blocks*100);
                }

                if($division_user->average_notes >= 59 && $division_user->attendance_percentage >= 62) {
                    $division_user->approve = true;
                }

                $division_user->save();
            }

            if(!is_null($approves)) {
                foreach ($approves as $key => $value) {
                    $user = DivisionUser::find($key);

                    if($value == 1) 
                        $user->approve = true;
                    else 
                        $user->approve = false;

                    $user->save();
                }
            }

            $grade->archived = true;
            $grade->save();

            return redirect()->route('grade.index');
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Show questionary.
     *
     * @param string $questionary_id
     *
     * @return @return \Illuminate\View\View
     */
    public function show_questionary($questionary_id, $block_grade_id) {
        if(Auth::user()->rol_id == Rol::ALUMNO) {
            $block_grade = BlockGrade::find($block_grade_id);
            $questionary = Questionary::findOrFail($questionary_id);
            
            $division_user = DivisionUser::where([
                ['grade_id', $block_grade->grade->id],
                ['user_id', Auth::user()->id]
            ])->first()->id;

            $block_grade_user = $block_grade->block_grade_users->where('division_user_id', $division_user)->first();
            
            return view('backend.grade.show_questionary', compact('questionary', 'block_grade_user'));
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Sumary questionary.
     *
     * @param string $questionary_id
     *
     * @return @return \Illuminate\View\View
     */
    public function summary_questionary($questionary_id, $grade_id) {
        if(Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::COORDINADOR) {
            $grade = Grade::find($grade_id);
            $answers = Answer::where('grade_id', $grade->id)->get();
            
            return view('backend.grade.summary_questionary', compact('answers', 'grade'));
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Answer questionary.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function answer_questionary(Request $request, $questionary_id, $block_grade_user_id) {
        if(Auth::user()->rol_id == Rol::ALUMNO) {
            $questionary = Questionary::find($questionary_id)->toArray();
            $block_grade_user = BlockGradeUser::find($block_grade_user_id);
        
            $answerData = [
                'answers' => $request->all(),
                'questionary' => $questionary,
                'user_id' => Auth::user()->id,
                'grade_id' => intval($block_grade_user->block_grade->grade->id),
                'block_grade_id' => intval($block_grade_user->block_grade->id),
                'block_grade_user_id' => intval($block_grade_user_id),
            ];

            $answer = Answer::create($answerData);

            return redirect()->route('grade.view', $block_grade_user->block_grade->grade->id);
        }
        else {
            return redirect()->back();
        }
    }

}
