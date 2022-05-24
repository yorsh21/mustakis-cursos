<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Postulation.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.help.index');
    }
}
