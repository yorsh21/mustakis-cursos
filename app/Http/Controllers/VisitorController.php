<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 30/01/2018
 * Time: 14:19
 */

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Postulation;
use App\Models\Parameter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Mail\ConfirmEmail;

class VisitorController extends Controller
{
    /**
     * Show main page to login.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        if(Auth::guest()){
            return view('frontend.index');
        }
        else {
            return redirect()->route('sumary');
        }
        
    }

    /**
     * Show User Register Form.
     *
     * @param int $rol_id
     *
     * @return \Illuminate\View\View
     */
    public function viewFormRegisterUser()
    {
        $objcomuna = new Commune();
        $comunas = $objcomuna->getCommunes();
        $register_text = Parameter::where('key', 'texto_registro')->first();

        return view('frontend.register')->with('comunas', $comunas)->with('register_text', $register_text);
    }

    /**
     * Save New User.
     *
     * @param int $rol_id
     *
     * @return \Illuminate\View\View
     */
    public function RegisterUser(Request $request)
    {
        $data = request()->all();
        if($data['passport'] == null){
            $data = request()->validate([
                'firstname' => 'required|min:3|max:35',
                'lastname' => 'required|min:3|max:35',
                'email' => 'required|email|unique:users,email|max:80',
                'password' => 'required|min:6|max:35',
                'rut' => 'required|unique:users,rut|min:9|max:10',
            ],
            [
                'firstname.required' => 'Requerido',
                'lastname.required' => 'Requerido',
                'email.required' => 'Requerido',
                'password.required' => 'Requerido',
                'rut.required' => 'Requerido',
                'rut.unique' => 'El rut ingresado ya se encuentra en el sistema',
            ]);
            $document_number = $data['rut'];
        }
        else {
            $data = request()->validate([
                'firstname' => 'required|min:3|max:35',
                'lastname' => 'required|min:3|max:35',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6|max:35',
                'passport' => 'required|unique:users,rut|min:6|max:50',
            ],
            [
                'firstname.required' => 'Requerido',
                'lastname.required' => 'Requerido',
                'email.required' => 'Requerido',
                'password.required' => 'Requerido',
                'passport.unique' => 'El pasaporte ingresado ya se encuentra en el sistema',
                'passport.min' => 'Mínimo 6 caracteres',
                'passport.max' => 'Maximo 50 caracteres',
            ]);
            $document_number = $data['passport'];
        }

        $sha = sha1($data['firstname'] . $data['lastname'] . $document_number . date('Y-m-d\TH:i:s'));

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'rut' => $document_number,
            'score_course' => 0,
            'password' => bcrypt($data['password']),
            'sha' => $sha,
            'rol_id' => 4,
        ]);

        return view('frontend.exito');
    }

    public function recover_password() {
        return view('frontend.recover');
    }

    public function recover_send_email(Request $request) {
        $user = User::where('email', $request->email)->first();
        if(is_null($user)){
            $request->session()->flash('status0', 'El correo ingresado no se encuentra registrado');
            return redirect()->route('recover.password'); 
        }
        else {
            $user->sha = sha1($user->rut . date('Y-m-d\TH:i:s') . $user->rut);
            $user->save();

            \Mail::to($user->email)->send(new ConfirmEmail($user));
            $request->session()->flash('status1', 'Correo de recuperación enviado correctamente');
            return redirect()->route('recover.password'); 
        }
    }

    public function recover_verify_token($id, $token)
    {
        $user = User::find($id);
        if(!is_null($user)) {
            if($user->sha == $token){
                return view('frontend.recover_password')
                    ->with('status', '0')->with('id', $id)
                    ->with('token', $token);
            }
        }
        return view('frontend.recover_password')->with('status', '1');
    }

    public function restart_password(Request $request)
    {
        $user = User::find($request->id);
        if(!is_null($user)) {
            if($request->token != $user->sha){
                return view('frontend.recover_password')->with('status', '1');
            }
            elseif($user->rut != $request->rut) {
                return view('frontend.recover_password')
                    ->with('status', '0')
                    ->with('id', $request->id)
                    ->with('token', $request->token)
                    ->with('message', 'El rut ingresado no corresponde al de esta solicitud');
            }
            else {
                $user->password = bcrypt($request->password);
                $user->save();
                return view('frontend.password_changed');
            }
        }
        else {
            return view('frontend.recover_password')->with('status', '1');
        }
    }

}