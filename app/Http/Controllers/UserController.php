<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Session;
use App\Models\User;
use App\Models\Campus;
use App\Models\SchoolWorkshop;
use App\Models\Period;
use App\Models\Course;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Rol;
use App\Models\DivisionUser;
use App\Models\Parameter;
use App\Models\Postulation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Get the roles name in plural.
     *
     * @param int $id
     *
     * @return string
     */
    private function rol_names($id)
    {
        $rol_name = '';
        switch ($id) {
            case Rol::ADMIN:
                $rol_name = 'Administradores';
                break;
            case Rol::COORDINADOR:
                $rol_name = 'Coordinadores';
                break;
            case Rol::PROFESOR:
                $rol_name = 'Mentores';
                break;
            case Rol::ALUMNO:
                $rol_name = 'Alumnos';
                break;
            case Rol::VOLUNTARIO:
                $rol_name = 'Mediadores';
                break;
            case Rol::ASESOR:
                $rol_name = 'Asesor';
                break;
            default:
                break;
        }

        return $rol_name;
    }

    /**
     * Show Welcome Page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->sha = '';
        $user->save();

        $init_text = Parameter::where('key', 'texto_inicio')->first();

        return view('backend.index')->with('init_text', $init_text);
    }

    /**
     * Show form search users.
     *
     * @return \Illuminate\View\View
     */
    public function search($rol)
    {
        $schoolworkshops = SchoolWorkshop::all();
        $periods = Period::all();
        $campus = Campus::all();

        return view('backend.user.search')
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol)
                ->with('schoolworkshops', $schoolworkshops)
                ->with('periods', $periods)
                ->with('campus', $campus);
    }

    /**
     * Show form search users.
     *
     * @return \Illuminate\View\View
     */
    public function search_list(Request $request)
    {
        $rol = intval($request->rol);
        if(Auth::user()->has_rol(Rol::ADMIN)){
            $search = isset($request->search) ? strtolower($request->search) : null;
            $campus = isset($request->campus_id) ? intval($request->campus_id) : null;
            $period = isset($request->period_id) ? intval($request->period_id) : null;
            $school = isset($request->school_workshop_id) ? intval($request->school_workshop_id) : null;

            $users_raw = User::where('rol_id', $rol)->orWhere('multiroles', $rol)->get();
            $users = $users_raw->filter(function ($user, $key) use($search, $campus, $period, $school){
                $findSearch = false;
                $findCampus = false;
                $findPeriod = false;
                $findSchool = false;

                if(!is_null($search)) {
                    $findSearch = strpos(strtolower($user->firstname), $search) !== false || 
                    strpos(strtolower($user->lastname), $search) !== false || 
                    strpos(strtolower($user->email), $search) !== false || 
                    strpos(strtolower($user->rut), $search) !== false || 
                    strpos(strtolower($user->phone_number), $search) !== false;
                }
                else {
                    $findSearch = true;
                }

                if(!is_null($campus)) {
                    foreach ($user->division_users as $division) {
                        if($division->grade->campus_id == $campus) {
                            $findCampus = true;
                            break;
                        }
                    }
                }
                else {
                    $findCampus = true;
                }

                if(!is_null($period)) {
                    foreach ($user->division_users as $division) {
                        if($division->grade->period_id == $period) {
                            $findPeriod = true;
                            break;
                        }
                    }
                }
                else {
                    $findPeriod = true;
                }

                if(!is_null($school)) {
                    foreach ($user->division_users as $division) {
                        if($division->grade->school_workshop_id == $school) {
                            $findSchool = true;
                            break;
                        }
                    }
                }
                else {
                    $findSchool = true;
                }
                
                return $findSearch && $findCampus && $findPeriod && $findSchool;
            });

            return view('backend.user.list_users', compact('search', 'campus', 'period', 'school'))
                ->with('users', $users)
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol);
        }
        elseif(Auth::user()->has_rol(Rol::COORDINADOR)){
            $region = Commune::find(Auth::user()->city_assist_workshop)->region_id;
            $campus = Campus::where('user_id', Auth::user()->id)->get();

            $users = collect();
            if($rol == Rol::ALUMNO) {
                foreach ($campus as $key => $campu) {
                    User::where([['rol_id', $rol], ['city_assist_workshop', $campu->commune_id]])->each(function($user, $key) use($users, $region, $rol) {
                        if($user->has_rol($rol) && isset($user->commune) && $user->commune->region_id == $region){
                            $users->push($user);
                        }
                    });
                }
            }
            elseif($rol == Rol::PROFESOR || $rol == Rol::VOLUNTARIO) {
                User::each(function($user, $key) use($users, $region, $rol) {
                    if($user->has_rol($rol) && isset($user->commune) && $user->commune->region_id == $region){
                        $users->push($user);
                    }
                });
            }
            else {
                return redirect()->back();
            }
    
            return view('backend.user.list_users')
                ->with('users', $users)
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol);
        }
        elseif(Auth::user()->has_rol(Rol::PROFESOR)){
            $region = Auth::user()->commune->region_id;
            $city = Auth::user()->commune_id;

            if($rol == Rol::ALUMNO){
                $users = User::where([['rol_id', $rol], ['city_assist_workshop', $city]])->get();
            }
            else{
                $users = collect();
                User::each(function($user, $key) use($users, $region, $rol) {
                    if($user->has_rol($rol) && isset($user->commune) && $user->commune->region_id == $region){
                        $users->push($user);
                    }
                });
            }
    
            return view('backend.user.list_users')
                ->with('users', $users)
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol);
        }
        else {
            return redirect()->back();
        }
    }


    /**
     * List all Users filter with Rol.
     *
     * @param int $rol
     *
     * @return \Illuminate\View\View
     */
    public function list_users($rol) 
    {
        if(Auth::user()->has_rol(Rol::ADMIN)){
            $users = User::where('rol_id', $rol)->orWhere('multiroles', $rol)->get();

            return view('backend.user.list_users')
                ->with('users', $users)
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol);
        }
        elseif(Auth::user()->has_rol(Rol::COORDINADOR)){
            $region = Commune::find(Auth::user()->city_assist_workshop)->region_id;
            $campus = Campus::where('user_id', Auth::user()->id)->get();

            $users = collect();
            if($rol == Rol::ALUMNO) {
                foreach ($campus as $key => $campu) {
                    User::where([['rol_id', $rol], ['city_assist_workshop', $campu->commune_id]])->each(function($user, $key) use($users, $region, $rol) {
                        if($user->has_rol($rol) && isset($user->commune) && $user->commune->region_id == $region){
                            $users->push($user);
                        }
                    });
                }
            }
            elseif($rol == Rol::PROFESOR || $rol == Rol::VOLUNTARIO) {
                User::each(function($user, $key) use($users, $region, $rol) {
                    if($user->has_rol($rol) && isset($user->commune) && $user->commune->region_id == $region){
                        $users->push($user);
                    }
                });
            }
            else {
                return redirect()->back();
            }
    
            return view('backend.user.list_users')
                ->with('users', $users)
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol);
        }
        elseif(Auth::user()->has_rol(Rol::PROFESOR)){
            $region = Auth::user()->commune->region_id;
            $city = Auth::user()->commune_id;

            if($rol == Rol::ALUMNO){
                $users = User::where([['rol_id', $rol], ['city_assist_workshop', $city]])->get();
            }
            else{
                $users = collect();
                User::each(function($user, $key) use($users, $region, $rol) {
                    if($user->has_rol($rol) && isset($user->commune) && $user->commune->region_id == $region){
                        $users->push($user);
                    }
                });
            }
    
            return view('backend.user.list_users')
                ->with('users', $users)
                ->with('names', $this::rol_names($rol))
                ->with('rol_id', $rol);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created User in storage.
     *
     * @param int $rol_id
     *
     * @return \Illuminate\View\View
     */
    public function crear($rol_id) 
    {
        if($rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::PROFESOR || Auth::user()->rol_id == Rol::ALUMNO || Auth::user()->rol_id == Rol::VOLUNTARIO || Auth::user()->rol_id == Rol::ASESOR) {
            return redirect()->back();
        }
        else if(Auth::user()->rol_id == Rol::COORDINADOR) {
            $rol = Rol::find(Rol::VOLUNTARIO);
        }
        else {
            $rol = Rol::find($rol_id);
        }
        $regiones = Region::all();
        $comunas = Commune::orderBy('name')->get();

        return view('backend.user.create')
            ->with('rol', $rol)
            ->with('regiones', $regiones)
            ->with('comunas', $comunas);
    }

    /**
     * Store full perfil the a User.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function guardar_completo(Request $request) 
    {
        if(
            ($request->rol_id == Rol::ADMIN || $request->rol_id == Rol::COORDINADOR) || 
            (Auth::user()->rol_id == Rol::COORDINADOR && ($request->rol_id == Rol::COORDINADOR || $request->rol_id == Rol::PROFESOR)) ||
            (Auth::user()->rol_id == Rol::PROFESOR || Auth::user()->rol_id == Rol::ALUMNO || Auth::user()->rol_id == Rol::VOLUNTARIO || Auth::user()->rol_id == Rol::ASESOR)
        ) {
            return redirect()->back();
        }
        
        request()->validate([
            'rol_id' => 'required',
            'firstname' => 'required|min:3|max:35',
            'middlename' => '',
            'lastname' => 'required|min:3|max:35',
            'lastname2' => '',
            'rut' => 'required|unique:users,rut',
            'genere' => 'required',
            'region' => '',
            'commune_id' => '',
            'address' => '',
            'study_career' => '',
            'study_institution' => '',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:35',
        ],
        [
            'rol_id.required' => "Este campo es requerido",
            'firstname.required' => "Este campo es requerido",
            'lastname.required' => "Este campo es requerido",
            'rut.required' => "Este campo es requerido",
            'rut.unique' => "El rut ingresado ya se encuentra registrado",
            'genere.required' => "Este campo es requerido",
            'email.required' => "Este campo es requerido",
            'email.unique' => "El correo ingresado ya se encuentra registrado",
            'password.required' => "Este campo es requerido",
        ]);

        User::create([
            'rol_id' => $request->rol_id,
            'firstname' => $request->firstname . ' ' . $request->middlename,
            'lastname' => $request->lastname . ' ' . $request->lastname2,
            'rut' => $request->rut,
            'genere' => $request->genere,
            'phone_number' => $request->phone_number,
            'commune_id' => $request->commune_id,
            'address' => $request->address,
            'especiality' => $request->study_career,
            'establishment' => $request->study_institution,
            'email' => $request->email,
            'city_assist_workshop' => $request->city_assist_workshop,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user.list', $request->rol_id);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function guardar(Request $request)
    {
        request()->validate([
            'firstname' => 'required|min:3|max:35',
            'lastname' => 'required|min:3|max:35',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:35',
            'rut' => 'required|unique:users,rut',
        ],
        [
            'firstname.required' => 'Requerido',
            'lastname.required' => 'Requerido',
            'email.required' => 'Requerido',
            'email.unique' => 'El correo ingresado ya esta en uso',
            'password.required' => 'Requerido',
            'rut.required' => 'Requerido',
            'rut.unique' => 'El rut o pasaporte ya esta en uso',
        ]);

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'rut' => $request->rut,
            'password' => bcrypt($request->password),
            'rol_id' => $request->rol_id,
        ]);

        return redirect()->route('user.list', $request->rol_id);
    }

    /**
     * Edit an specific User in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $avatars = ['boy.png', 'boy1.png', 'burglar.png', 'businessman.png', 'businessman1.png', 'businesswoman.png', 'customer-service.png', 'default.png', 'doctor.png', 'doctor2.png', 'doctor3.png', 'doctora.png', 'doctora2.png', 'engineer.png', 'farmer.png', 'followers.png', 'girl.png', 'girl1.png', 'girl2.png', 'graduate.png', 'graduates.png', 'journalist.png', 'man.png', 'man2.png', 'man3.png', 'man4.png', 'man5.png', 'nurse.png', 'police.png', 'policeman.png', 'robot.png', 'seo.png', 'soldier.png', 'student.png', 'taxi-driver.png', 'teacher.png', 'teacher1.png', 'telemarketer.png', 'user.png', 'user1.png', 'user2.png', 'user3.png', 'user4.png', 'user5.png', 'user6.png', 'user7.png', 'user8.png', 'woman.png', 'worker.png'];

        $establishments = Course::all();
        $regiones = Region::all();
        $roles = Rol::where('id', '!=', 1)->get();
        $comunas = Commune::orderBy('name')->get();
        $cities = Campus::all()->pluck('commune.id', 'name');
        
        if(Auth::user()->rol_id != Rol::ADMIN){
            $user = User::findOrFail(Auth::user()->id);
        }
        else{
            $user = User::findOrFail($id);
        }
        
        if(empty($user->multiroles)) {
            $multiroles = [];
        }
        else {
            $multiroles = explode(",", $user->multiroles)[0]; //Regla de Negocio: solo 2 roles por usuario
        }
        
        return view('backend.user.edit_profile')
            ->with('establishments', $establishments)
            ->with('regiones', $regiones)
            ->with('comunas', $comunas)
            ->with('cities', $cities)
            ->with('profile', $user)
            ->with('roles', $roles)
            ->with('multiroles', $multiroles)
            ->with('avatars', $avatars);
    }

    /**
     * Update the User in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $id = $request->id;
        }
        else {
            $id = Auth::user()->id;
        }

        request()->validate([
            'firstname' => 'required|min:3|max:35',
            'lastname' => 'required|min:3|max:35',
            'phone_number' => 'required|min:9|max:9',
            'email' => 'required|unique:users,email,' . $id,
            'rut' => 'required|unique:users,rut,' . $id,
        ],
        [
            'firstname.required' => 'Requerido',
            'lastname.required' => 'Requerido',
            'phone_number.required' => 'Requerido',
            'email.required' => 'Requerido',
            'email.unique' => 'El correo ingresado ya esta en uso',
            'rut.required' => 'Requerido',
            'rut.unique' => 'El rut o pasaporte ingresado ya esta en uso',
        ]);

        $user = User::findOrFail($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->phone_number2 = $request->phone_number2;
        $user->genere = $request->genere;
        $user->address = $request->address;
        $user->commune_id = $request->commune_id;
        $user->image_profile = $request->image_profile;
        $user->birth_date = $request->birth_date;
        
        
        if($user->rol_id == Rol::ALUMNO){
            $user->email_tutor = $request->email_tutor;
            $user->email_teacher = $request->email_teacher;
            $user->phone_number_tutor = $request->phone_number_tutor;
            $user->course = $request->course;
            $user->establishment = $request->establishment;
            $user->type_establishment_student = $request->type_establishment_student;
            $user->transport_establishment = $request->transport_establishment;
            $user->dependency_establishment_student = $request->dependency_establishment_student;
            $user->about_select_workshop = $request->about_select_workshop;
            $user->city_assist_workshop = $request->city_assist_workshop;

            if (is_null($request->new_school_commune) || empty($request->new_school_commune)) {
                $user->establishment = $request->establishment;
            } else {
                $user->establishment = $request->new_school_commune;
            }

            //Calculo de puntaje y ponderacion
            $user->calculate_score($user);
        }
        else {
            $user->study_career = $request->study_career;
            $user->study_institution = $request->study_institution;
        }

        if($user->rol_id == Rol::COORDINADOR){
            $user->city_assist_workshop = $request->city_assist_workshop;
        }

        if(Auth::user()->rol_id == Rol::ADMIN){
            $user->rut = $request->rut;
        }

        $user->save();
        return redirect()->route('user.show.profile', $id);
    }

    /**
     * Update password the User in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_password(Request $request)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $id = $request->id;
        }
        else {
            $id = Auth::user()->id;
        }

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);

        $user->save();
        return redirect()->route('user.show.profile', $id);
    }

    /**
     * Update roles the User in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_roles(Request $request)
    {
        $user = User::findOrFail($request->id);
        $rol1 = isset($request->multiroles1) ? $request->multiroles1 :  $user->rol_id;
        $rol2 = isset($request->multiroles2) ? $request->multiroles2 :  $user->multiroles;
        
        if($rol1 == $rol2) {
            return redirect()->back()->withErrors(['multiroles' => 'El rol primario y secundario no pueden ser iguales']);
        }

        if(Auth::user()->rol_id == Rol::ADMIN) {
            if(isset($request->multiroles1)) {
                $user->rol_id = $request->multiroles1;
            }

            if(isset($request->multiroles2)) {
                $user->multiroles = $request->multiroles2;
            }
            else {
                $user->multiroles = '';
            }

            $user->save();
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Switch Roles a specific User.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function switch_roles() {
        if(!empty(Auth::user()->multiroles)) {
            $user = User::findOrFail(Auth::user()->id);
            
            $temp = $user->rol_id;
            $user->rol_id = $user->multiroles;
            $user->multiroles = $temp;
            $user->save();
        }

        return redirect()->back();
    }

    /**
     * Show View to Update Form Personal.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function form_personal($id = null)
    {
        if(Auth::user()->rol_id == Rol::ADMIN && !is_null($id)) {
            $usuario = User::find($id);
        }
        else {
            $usuario = User::find(\Auth::user()->id);
        }
        
        $regiones = Region::all();
        $comunas = Commune::orderBy('name')->get();

        return view('backend.user.form_personal')
            ->with('user', $usuario)
            ->with('regiones', $regiones)
            ->with('comunas', $comunas);
    }

    /**
     * Show View to Update Form Documentacion.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function form_documentacion($id = null)
    {
        if(Auth::user()->rol_id == Rol::ADMIN && !is_null($id))
            $usuario = User::find($id);
        else
            $usuario = User::find(\Auth::user()->id);
        
        $documentos = [];
        Parameter::where('type', 'document')->get()->each(function ($item, $key) use(&$documentos) {
            if(empty($item->value))
                $documentos[$item->key] = '';
            else
                $documentos[$item->key] = '<a href="' . route('document.download', $item->id) . '" target="_blank">Descarga formato <i class="fa fa-download" aria-hidden="true"></i></a><br>';
        });

        return view('backend.user.form_documentacion')->with('user', $usuario)->with('documents', $documentos);
    }

    /**
     * Show View to Update Form Establecimiento.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function form_establecimiento($id = null)
    {
        if(Auth::user()->rol_id == Rol::ADMIN && !is_null($id)) {
            $usuario = User::find($id);
        }
        else {
            $usuario = User::find(\Auth::user()->id);
        }

        $establishments = Course::all();
        $regions = Region::all()->pluck('id', 'name');
        $cities = Campus::all()->pluck('commune.id', 'name');
        
        return view('backend.user.form_establecimiento')
            ->with('user', $usuario)
            ->with('establishments', $establishments)
            ->with('cities', $cities)
            ->with('regions', $regions);
    }

    /**
     * Show View to Update Encuesta.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function form_encuesta($id = null)
    {
        if(Auth::user()->rol_id == Rol::ADMIN && !is_null($id)) {
            $usuario = User::find($id);
        }
        else {
            $usuario = User::find(\Auth::user()->id);
        }
        
        return view('backend.user.form_encuesta')->with('user', $usuario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_personal(Request $request)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $usuario = User::find($request->user_id);
        }
        else {
            $usuario = User::find(\Auth::user()->id);
        }

        $usuario->birth_date = $request->birth_date;
        $usuario->genere = $request->gender;
        $usuario->phone_number = $request->phone_number;
        $usuario->phone_number2 = $request->phone_number2;
        $usuario->address = $request->address;
        $usuario->email_tutor = $request->email_tutor;
        $usuario->email_teacher = $request->email_teacher;
        $usuario->course = $request->course;
        $usuario->commune_id = $request->commune_id;
        $usuario->phone_number_tutor = $request->phone_number_tutor;

        //Calculo de puntaje y ponderacion
        $usuario->calculate_score($usuario);

        $usuario->save();
        return redirect()->back();
    }

    /**
     * Update Documentacion.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_documentacion(Request $request)
    {
        $request->validate([
            User::AUTH_DOC => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::SCHOOL_DOC => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::AUTH_DOC2 => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::SCHOOL_DOC2 => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::CESSION_DOC => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::LICENSE_STUDENT => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::LICENSE_TUTOR => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
            User::RECOMENDATION_DOC => 'file|mimes:pdf,jpeg,png,docx,doc|max:2048',
        ]);

        $archivo_auth_doc = $request->file(User::AUTH_DOC);
        $archivo_school_doc = $request->file(User::SCHOOL_DOC);
        $archivo_auth_doc2 = $request->file(User::AUTH_DOC2);
        $archivo_school_doc2 = $request->file(User::SCHOOL_DOC2);
        $archivo_cession_doc = $request->file(User::CESSION_DOC);
        $archivo_license_student = $request->file(User::LICENSE_STUDENT);
        $archivo_license_tutor = $request->file(User::LICENSE_TUTOR);
        $archivo_recomendation_doc = $request->file(User::RECOMENDATION_DOC);

        if(Auth::user()->rol_id == Rol::ADMIN) {
            $usuario = User::find($request->user_id);
        }
        else {
            $usuario = User::find(\Auth::user()->id);
        }

        if ($archivo_auth_doc != null) {
            $file_hash1 = Storage::disk('public')->put('', $archivo_auth_doc);
            if(is_file(public_path("files") . "/" . $usuario->auth_doc))
                unlink(public_path("files") . "/" . $usuario->auth_doc);
            $usuario->auth_doc = $file_hash1;
        }
        if ($archivo_school_doc != null) {
            $file_hash2 = Storage::disk('public')->put('', $archivo_school_doc);
            if(is_file(public_path("files") . "/" . $usuario->school_doc))
                unlink(public_path("files") . "/" . $usuario->school_doc);
            $usuario->school_doc = $file_hash2;
        }

        if ($archivo_auth_doc2 != null) {
            $file_hash1_2 = Storage::disk('public')->put('', $archivo_auth_doc2);
            if(is_file(public_path("files") . "/" . $usuario->auth_doc2))
                unlink(public_path("files") . "/" . $usuario->auth_doc2);
            $usuario->auth_doc2 = $file_hash1_2;
        }
        if ($archivo_school_doc2 != null) {
            $file_hash2_2 = Storage::disk('public')->put('', $archivo_school_doc2);
            if(is_file(public_path("files") . "/" . $usuario->school_doc2))
                unlink(public_path("files") . "/" . $usuario->school_doc2);
            $usuario->school_doc2 = $file_hash2_2;
        }

        if ($archivo_cession_doc != null) {
            $file_hash3 = Storage::disk('public')->put('', $archivo_cession_doc);
            if(is_file(public_path("files") . "/" . $usuario->cession_doc))
                unlink(public_path("files") . "/" . $usuario->cession_doc);
            $usuario->cession_doc = $file_hash3;
        }

        if ($archivo_license_student != null) {
            $file_hash4 = Storage::disk('public')->put('', $archivo_license_student);
            if(is_file(public_path("files") . "/" . $usuario->license_student))
                unlink(public_path("files") . "/" . $usuario->license_student);
            $usuario->license_student = $file_hash4;
        }
        if ($archivo_license_tutor != null) {
            $file_hash5 = Storage::disk('public')->put('', $archivo_license_tutor);
            if(is_file(public_path("files") . "/" . $usuario->license_tutor))
                unlink(public_path("files") . "/" . $usuario->license_tutor);
            $usuario->license_tutor = $file_hash5;
        }
        if ($archivo_recomendation_doc != null) {
            $file_hash6 = Storage::disk('public')->put('', $archivo_recomendation_doc);
            if(is_file(public_path("files") . "/" . $usuario->recomendation_doc))
                unlink(public_path("files") . "/" . $usuario->recomendation_doc);
            $usuario->recomendation_doc = $file_hash6;
        }

        $usuario->save();
        return redirect()->back();
    }

    /**
     * Update Establecimiento.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_establecimiento(Request $request)
    {
        if(Auth::user()->rol_id == Rol::ADMIN)
            $usuario = User::find($request->user_id);
        else
            $usuario = User::find(\Auth::user()->id);

        $usuario->commune_establishment_student = $request->commune_establishment_student;
        $usuario->dependency_establishment_student = $request->dependency_establishment_student;
        $usuario->type_establishment_student = $request->type_establishment_student;
        $usuario->especiality = $request->especiality;
        $usuario->transport_establishment = $request->transport_establishment;
        $usuario->special_needs = $request->special_needs;
        $usuario->needs_student = $request->needs_student;
        $usuario->city_assist_workshop = $request->city_assist_workshop;
        $usuario->workshop_puerto_montt = $request->workshop_puerto_montt;
        $usuario->horary_preference = $request->horary_preference;
        $usuario->establishment_workshop_robotic = $request->establishment_workshop_robotic;
        $usuario->about_select_workshop = $request->about_select_workshop;
        $usuario->first_contact_robotic = $request->first_contact_robotic;
        $usuario->broadcast_first_contact = $request->broadcast_first_contact;
        $usuario->doing_postulation = $request->doing_postulation;


        if (is_null($request->new_school_commune) || empty($request->new_school_commune)) {
            $usuario->establishment = $request->establishment;
        } else {
            $usuario->establishment = $request->new_school_commune;
        }

        //Calculo de puntaje y ponderacion
        $usuario->calculate_score($usuario);

        $usuario->save();
        return redirect()->back();
    }

    /**
     * Update Encuesta.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_encuesta(Request $request)
    {
        $data = $request->all();
        if(Auth::user()->rol_id == Rol::ADMIN)
            $usuario = User::find($request->user_id);
        else
            $usuario = User::find(\Auth::user()->id);

        if (isset($data["motivation"])) {
            $cadena = implode(",", $data['motivation']);
            $usuario->motivation = $cadena;
        }

        if (isset($data["features_workshop"])) {
            $cadena = implode(",", $data['features_workshop']);
            $usuario->features_workshop = $cadena;
        }

        if (isset($data['experience_platform'])) {
            $cadena = implode(",", $data['experience_platform']);
            $usuario->experience_platform = $cadena;
        }

        if (isset($data['find_about_workshop'])) {
            $usuario->find_about_workshop = $data["find_about_workshop"];
        }

        if (isset($data['school_workshop'])) {
            $usuario->school_workshop = $data["school_workshop"];
        }

        if (isset($data['participate_school_workshop'])) {
            $usuario->participate_school_workshop = $data["participate_school_workshop"];
        }

        if (isset($data['participate_other_workshop'])) {
            $usuario->participate_other_workshop = $data["participate_other_workshop"];
        }

        if (isset($data['participate_tournament_robotic'])) {
            $usuario->participate_tournament_robotic = $data["participate_tournament_robotic"];
        }

        if (isset($data['robot_home'])) {
            $usuario->robot_home = $data["robot_home"];
        }

        if (isset($data['knowledge_programation'])) {
            $usuario->knowledge_programation = $data["knowledge_programation"];
        }

        if (isset($data['education_level'])) {
            $usuario->education_level = $data["education_level"];
        }

        if (isset($data['study_career'])) {
            $usuario->study_career = $data["study_career"];
        }

        if (isset($data['study_institution'])) {
            $usuario->study_institution = $data["study_institution"];
        }

        $usuario->save();
        return redirect()->back();
    }

    /**
     * Show User Profile.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function user_profile($id)
    {
        if(Auth::user()->rol_id == Rol::ALUMNO || Auth::user()->rol_id == Rol::VOLUNTARIO || Auth::user()->rol_id == Rol::ASESOR){
            $user = User::find(Auth::user()->id);
        } 
        else{
            $user = User::find($id);
        }

        if(is_null($user)) {
            return redirect()->back();
        }
        else {
            switch ($user->rol_id) {
                case Rol::ADMIN:
                    $view = 'backend.user.show_coordinator_profile';
                    break;
                case Rol::COORDINADOR:
                    $view = 'backend.user.show_coordinator_profile';
                    break;
                case Rol::PROFESOR:
                    $view = 'backend.user.show_teacher_profile';
                    break;
                case Rol::ALUMNO:
                    $view = 'backend.user.show_student_profile';
                    break;
                case Rol::VOLUNTARIO:
                    $view = 'backend.user.show_voluntary_profile';
                    break;
                case Rol::ASESOR:
                    $view = 'backend.user.show_assessor_profile';
                    break;
                default:
                    $view = '';
                    break;
            }

            if(empty($view)) {
                return redirect()->back();
            }
            else {
                return view($view)->with('user', $user);
            }
        }
    }

    /**
     * Download specific Document.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $user
     *
     * @return \Illuminate\Http\Response|Download
     */
    public function download_document($document, $user = null)
    {
        if(Auth::user()->rol_id == Rol::ADMIN){
            if(is_null($user))
                return redirect()->back();
            else
                $usuario = User::find($user);
        }
        else
            $usuario = User::find(\Auth::user()->id);

        switch ($document) {
            case User::AUTH_DOC:
                $name_file = "autorización_tutor_legal_";
                break;
            case User::SCHOOL_DOC:
                $name_file = "carta_compromiso_colegio_";
                break;
            case User::AUTH_DOC2:
                $name_file = "adicional_autorización_tutor_legal_";
                break;
            case User::SCHOOL_DOC2:
                $name_file = "adicional_carta_compromiso_colegio_";
                break;
            case User::CESSION_DOC:
                $name_file = "carnet_identidad_alumno_";
                break;
            case User::LICENSE_STUDENT:
                $name_file = "carnet_identidad_alumno_";
                break;
            case User::LICENSE_TUTOR:
                $name_file = "carnet_identidad_tutor_";
                break;
            case User::RECOMENDATION_DOC:
                $name_file = "carta_recomendación_";
                break;
            case User::SERVICE_TO_STUDENT:
                $name_file = "declaración_establecimiento_";
                break;
            default:
                $name_file = "documento";
                break;
        }

        $name_file .= $usuario->id;
        $extension = explode('.', $usuario->$document)[1];
        
        if(is_file(public_path('files/') . $usuario->$document)) {
            return response()->download(public_path('files/') . $usuario->$document, $name_file . '.' . $extension);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Update Scores for all Users.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_scores() {
        if (Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::COORDINADOR) {
            $users = User::all();
            foreach ($users as $user) {
                $user->calculate_score();
                $user->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Update Motivation Score to specific User.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function score_motivation(Request $request) {
        $usuario = User::find($request->id);
        $usuario->score_motivation = $request->score_motivation;
        $usuario->save();

        return response()->json([
            'id' => $request->id, 
            'score_global' => $usuario->score + $usuario->score_motivation, 
            'score_motivation' => $usuario->score_motivation
        ]);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(Auth::user()->rol_id == 1) {
            return redirect()->back();
        }
        else if(Auth::user()->rol_id == Rol::ADMIN) {
            User::destroy($id);
        }
        else if(Auth::user()->rol_id == Rol::COORDINADOR && User::find($id)->rol_id == Rol::VOLUNTARIO) {
            User::destroy($id);
        }
        
        return redirect()->back();
    }

    /**
     * Download full information to Rol.
     *
     * @param int $rol
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function descarga_rol(Request $request) {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $rol = intval($request->rol);
            $search = !is_null($request->search) ? strtolower($request->search) : null;
            $campus = !is_null($request->campus) ? intval($request->campus) : null;
            $period = !is_null($request->period) ? intval($request->period) : null;
            $school = !is_null($request->school) ? intval($request->school) : null;

            $users_raw = User::where('rol_id', $rol)->orWhere('multiroles', $rol)->get();
            $users = $users_raw->filter(function ($user, $key) use($search, $campus, $period, $school){
                $findSearch = false;
                $findCampus = false;
                $findPeriod = false;
                $findSchool = false;

                if(!is_null($search)) {
                    $findSearch = strpos(strtolower($user->firstname), $search) !== false || 
                    strpos(strtolower($user->lastname), $search) !== false || 
                    strpos(strtolower($user->email), $search) !== false || 
                    strpos(strtolower($user->rut), $search) !== false || 
                    strpos(strtolower($user->phone_number), $search) !== false;
                }
                else {
                    $findSearch = true;
                }

                if(!is_null($campus)) {
                    foreach ($user->division_users as $division) {
                        if($division->grade->campus_id == $campus) {
                            $findCampus = true;
                            break;
                        }
                    }
                }
                else {
                    $findCampus = true;
                }

                if(!is_null($period)) {
                    foreach ($user->division_users as $division) {
                        if($division->grade->period_id == $period) {
                            $findPeriod = true;
                            break;
                        }
                    }
                }
                else {
                    $findPeriod = true;
                }

                if(!is_null($school)) {
                    foreach ($user->division_users as $division) {
                        if($division->grade->school_workshop_id == $school) {
                            $findSchool = true;
                            break;
                        }
                    }
                }
                else {
                    $findSchool = true;
                }

                return $findSearch && $findCampus && $findPeriod && $findSchool;
            });

            return view('backend.user.info')->with('users', $users);
        }
        return redirect()->back();
    }

    /**
     * Set Mute to User.
     *
     * @param int $id
     * @param int $time
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function mute($id, $time) {
        if(Auth::user()->rol_id == Rol::ADMIN || Auth::user()->rol_id == Rol::COORDINADOR || Auth::user()->rol_id == Rol::PROFESOR) {
            $date = Carbon::now('Chile/Continental');
            $date->addHours($time);

            $user = User::findOrFail($id);
            $user->mute = $date;
            $user->save();
        }
        Session::put('select_view', 'notas');

        return redirect()->back();
    }

}