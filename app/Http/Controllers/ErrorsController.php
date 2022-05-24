<?php

namespace App\Http\Controllers;

class ErrorsController extends Controller
{

    public function error401(){
        return view('error401');
    }

    public function error404(){
        return view('error404');
    }

}