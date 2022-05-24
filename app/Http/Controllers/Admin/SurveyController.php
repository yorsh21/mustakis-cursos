<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Questionary;
use App\Models\User;
use App\Models\Rol;

class SurveyController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the Survey.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->rol_id == Rol::ADMIN) {
            $surveys = Survey::all();

            return view('backend.survey.index', compact('surveys'));
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new Survey.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $questionnaires = Questionary::all();

        return view('backend.survey.create', compact('questionnaires'));
    }

    /**
     * Display the Survey.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $survey = Survey::findOrFail($id);
        if(is_null($survey->questionnaires)) {
            $questionnaires = [];
        }
        else {
            $questionnaires = Questionary::whereIn("_id", $survey->questionnaires)->get();
        }

        return view('backend.survey.show', compact('survey', 'questionnaires'));
    }

    /**
     * Show the form for editing the Survey.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        $questionnaires = Questionary::all();

        return view('backend.survey.edit', compact('survey', 'questionnaires'));
    }

    /**
     * Show the form for editing the Survey.
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
            'questionnaires' => $request->questionnaires
        ];

        Survey::create($questionaryData);

        return redirect()->route('survey.index');
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
            'questionnaires' => $request->questionnaires
        ];

        $questionary = Survey::findOrFail($id);
        $questionary->update($questionaryData);

        return redirect()->route('survey.index');
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
        Survey::destroy($id);

        return redirect()->route('survey.index');
    }

}
    