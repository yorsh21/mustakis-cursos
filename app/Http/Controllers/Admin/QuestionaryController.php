<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Questionary;
use App\Models\User;
use App\Models\Rol;

class QuestionaryController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Questionary.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->rol_id == Rol::ADMIN) {
            $questionnaires = Questionary::all();

            return view('backend.questionary.index', compact('questionnaires'));
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new Questionary.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.questionary.create');
    }

    /**
     * Display the Questionary.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $questionary = Questionary::findOrFail($id);

        return view('backend.questionary.show', compact('questionary'));
    }

    /**
     * Show the form for editing the Questionary.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $questionary = Questionary::findOrFail($id);

        return view('backend.questionary.edit', compact('questionary'));
    }

    /**
     * Show the form for editing the Questionary.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|min:3',
        ], [
            'requiered' => 'Este campo es requerido',
            'min' => 'Este campo debe tener al menos 3 caracteres'
        ]);

        $questionaryData = [
            'name' => $request->name,
            'description' => $request->description,
            'form' => json_decode($request->form)
        ];

        Questionary::create($questionaryData);

        return redirect()->route('questionary.index');
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
        request()->validate([
            'name' => 'required|min:3',
        ], [
            'requiered' => 'Este campo es requerido',
            'min' => 'Este campo debe tener al menos 3 caracteres'
        ]);

        $questionaryData = [
            'name' => $request->name,
            'description' => $request->description,
            'form' => json_decode($request->form)
        ];

        $questionary = Questionary::findOrFail($id);
        $questionary->update($questionaryData);

        return redirect()->route('questionary.index');
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
        Questionary::destroy($id);

        return redirect()->route('questionary.index');
    }

}
    