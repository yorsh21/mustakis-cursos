<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

class RolesAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guest()){
            return redirect('/');
        }
        else {
            return $next($request);
        }

        /*
        $estado = false;
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);

        if($controller == 'VisitorController') {
            if(Auth::guest()){
                return $next($request);
            }
            else {
                return redirect('inicio');
            }
        }
        else {
            if (Auth::guest()) {
                return redirect('');
            } 
            else {
                $permisos = User::find(Auth::user()->id)->rol->permissionrol->pluck('permission');

                foreach ($permisos as $permiso) {
                    if ($permiso->model == $controller && $permiso->action == $action) { // si existe coincidencia permitir flujo normal
                        $estado = true;
                    }
                }
                if ($estado == false) { //si el foreach no retorno nada, quiere decir que no tiene permisos
                    return redirect('error401');
                }
            }
        }
        return $next($request);
        */
    }
}
