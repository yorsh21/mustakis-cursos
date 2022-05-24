<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Storage;
use PDF;
use Zipper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\Commune;
use App\Models\Campus;
use App\Models\Grade;
use App\Models\Certificate;
use App\Models\User;

class CertificateController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::all();

        $files = glob(public_path('certificates/*.zip'));
        foreach($files as $file) {
            if(is_file($file))
                unlink($file);
        }

        return view('backend.certificate.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $background = $request->file("background");
        $properties = [];
        $fields = [];

        foreach (Certificate::ROWS as $key => $value) {
            if(array_search($key, $request->properties) !== false) {
                $properties[] =  [
                    "name" => $key,
                    "text" => $value,
                    "x_pos" => "0px",
                    "y_pos" => "0px",
                    "width" => "300px",
                    "height" => "40px",
                    "size" => "18px",
                    "color" => "#000000",
                ];
            }
            else {
                $properties[] =  [
                    "name" => $key,
                    "text" => null,
                    "x_pos" => "0px",
                    "y_pos" => "0px",
                    "width" => "300px",
                    "height" => "40px",
                    "size" => "18px",
                    "color" => "#000000",
                ];
            }
        }


        foreach ($request->fields as $key => $field) {
            $fields[] =  [
                "name" => "field" . $key,
                "text" => $field,
                "x_pos" => "0px",
                "y_pos" => "0px",
                "width" => "300px",
                "height" => "40px",
                "size" => "18px",
                "color" => "#000000",
            ];
        }

        if ($background != null) {
            $file_hash1 = Storage::disk('certificate')->put('', $background);
            if(is_file(public_path("certificates") . "/" . $request->background)) {
                unlink(public_path("certificates") . "/" . $request->background);
            }

            $certificate = Certificate::create([
                'name' => $request->name,
                'horizontal' => $request->horizontal == 1 ? true : false,
                'background' => $file_hash1,
                'properties' => $properties,
                'fields' => $fields,
            ]);
        }

        if($request->ajax()) {
            return response()->json(['certificate' => Certificate::findOrFail($certificate->first()->id)]);
        }
        else {
            return redirect()->route('certificate.index');
        }
    }

    /**
     * Display the specified certificate.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificate = Certificate::find($id);
        $data = $certificate->toArray();
        $data['background_url'] = asset($certificate->background_url);

        return view('backend.certificate.render', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::find($id);

        return view('backend.certificate.create', compact('certificate'));
    }

    /**
     * Show the form for generate the specified certificate.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function generate($id)
    {
        $certificate = Certificate::find($id);

        if(Auth::user()->has_rol(Rol::ADMIN)){
            $grades = Grade::all();
        }
        elseif(Auth::user()->has_rol(Rol::COORDINADOR)){
            $campus = Campus::where('user_id', Auth::user()->id)->pluck('id')->toArray();
            $grades = Grade::whereIn('campus_id', $campus)->get();
        }

        return view('backend.certificate.generate', compact('certificate', 'grades'));
    }

    /**
     * Display the specified certificate.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function download($certificate_id, $user_id)
    {
        $user = User::find($user_id);
        $certificate = Certificate::find($certificate_id);

        $data = $certificate->toArray();
        $data['background_url'] = public_path('certificates/') . $certificate->background;

        if($data['properties'][0]["text"] != null) $data['properties'][0]['text'] = $user->name;
        if($data['properties'][1]["text"] != null) $data['properties'][1]['text'] = $user->email;
        if($data['properties'][2]["text"] != null) $data['properties'][2]['text'] = $user->rut;
        if($data['properties'][3]["text"] != null) $data['properties'][3]['text'] = $user->birth_date;
        if($data['properties'][4]["text"] != null) $data['properties'][4]['text'] = $user->genere === 0 ? 'Masculino' : 'Femenino';
        if($data['properties'][5]["text"] != null) $data['properties'][5]['text'] = $user->phone_number;
        if($data['properties'][6]["text"] != null) $data['properties'][6]['text'] = $user->address;
        if($data['properties'][7]["text"] != null) $data['properties'][7]['text'] = $user->commune->name;
        if($data['properties'][8]["text"] != null) $data['properties'][8]['text'] = $user->commune->region->name;
        if($data['properties'][9]["text"] != null) $data['properties'][9]['text'] = $user->show_course;
        if($data['properties'][10]["text"] != null) $data['properties'][10]['text'] = $user->name_establishment;

        PDF::setOptions([
            'isRemoteEnabled' => true,
            'dpi' => 96, 
            'defaultFont' => 'sans-serif'
        ]);

        if($data['horizontal'] == 0) {
            $pdf = PDF::loadView('backend.certificate.render', compact('data'))->setPaper('a4');
        }
        else {
            $pdf = PDF::loadView('backend.certificate.render', compact('data'))->setPaper('a4', 'landscape');
        }
        return $pdf->download('certificado.pdf');
    }

    /**
     * Display the specified certificate.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function downloads($certificate_id, $grade_id)
    {
        $grade = Grade::find($grade_id);
        $certificate = Certificate::find($certificate_id);

        foreach ($grade->division_users as $division_user) {
            $data = $certificate->toArray();
            $data['background_url'] = public_path('certificates/') . $certificate->background;

            if($data['properties'][0]["text"] != null) $data['properties'][0]['text'] = $division_user->user->name;
            if($data['properties'][1]["text"] != null) $data['properties'][1]['text'] = $division_user->user->email;
            if($data['properties'][2]["text"] != null) $data['properties'][2]['text'] = $division_user->user->rut;
            if($data['properties'][3]["text"] != null) $data['properties'][3]['text'] = $division_user->user->birth_date;
            if($data['properties'][4]["text"] != null) $data['properties'][4]['text'] = $division_user->user->genere === 0 ? 'Masculino' : 'Femenino';
            if($data['properties'][5]["text"] != null) $data['properties'][5]['text'] = $division_user->user->phone_number;
            if($data['properties'][6]["text"] != null) $data['properties'][6]['text'] = $division_user->user->address;
            if($data['properties'][7]["text"] != null) $data['properties'][7]['text'] = $division_user->user->commune->name;
            if($data['properties'][8]["text"] != null) $data['properties'][8]['text'] = $division_user->user->commune->region->name;
            if($data['properties'][9]["text"] != null) $data['properties'][9]['text'] = $division_user->user->show_course;
            if($data['properties'][10]["text"] != null) $data['properties'][10]['text'] = $division_user->user->name_establishment;
    
            PDF::setOptions([
                'isRemoteEnabled' => true,
                'dpi' => 96, 
                'defaultFont' => 'sans-serif'
            ]);
    
            if($data['horizontal'] == 0) {
                $pdf = PDF::loadView('backend.certificate.render', compact('data'))->setPaper('a4');
            }
            else {
                $pdf = PDF::loadView('backend.certificate.render', compact('data'))->setPaper('a4', 'landscape');
            }
            
            $pdf->save(public_path('certificates/') . 'certificado' . $division_user->user->id . '.pdf');
        }

        $files = glob(public_path('certificates/*.pdf'));
        $name = 'certificates.zip';

        $zipper = new \Chumper\Zipper\Zipper;
        $zipper->make('certificates/' . $name )->add($files);
        $zipper->close();

        $files = glob(public_path('certificates/*.pdf'));
        foreach($files as $file) {
            if(is_file($file))
                unlink($file);
        }

        if(is_file(public_path('certificates/') . $name)) {
            return response()->download(public_path('certificates/') . $name);
        }
    }

    /**
     * Update the specified certificate in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);
        $background = $request->file("background");

        if (isset($request->all()["certificate"])) {
            $requestData = json_decode($request->certificate, true);
        }
        else {
            $requestData = [
                'name' => $request->name,
                'horizontal' => $request->horizontal == 1 ? true : false,
                'properties' => $certificate->properties,
                'fields' => $certificate->fields,
            ];

            $count = 0;
            foreach (Certificate::ROWS as $key => $value) {
                if(array_search($key, $request->properties) !== false) {
                    $requestData['properties'][$count]["text"] = $value;
                }
                else {
                    $requestData['properties'][$count]["text"] = null;
                }
                
                $count++;
            }
            
            foreach ($request->fields as $key => $value) {
                $requestData['fields'][$key]["text"] = $value;
            }
        }

        if ($background != null) {
            $file_hash1 = Storage::disk('certificate')->put('', $background);
            if(is_file(public_path("certificates") . "/" . $certificate->background))
                unlink(public_path("certificates") . "/" . $certificate->background);
            $requestData['background'] = $file_hash1;
        }

        //dd($requestData);
        $certificate->update($requestData);

        if($request->ajax()) {
            return response()->json(['certificate' => Certificate::find($certificate->id)]);
        }
        else {
            return redirect()->route('certificate.index');
        }
    }

    /**
     * Remove the specified certificate from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificate = Certificate::find($id);

        if(is_file(public_path("certificates/") . $certificate->background))
            unlink(public_path("certificates/") . $certificate->background);

        $certificate->delete();

        return redirect()->route('certificate.index');
    }
}
