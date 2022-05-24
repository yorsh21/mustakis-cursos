<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlockGrade;

class BlockGradeController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the BlockGrades.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $blockgrade = BlockGrade::all();

        return view('backend.block-grade.index', compact('blockgrade'));
    }

    /**
     * Show the form for creating a new BlockGrade.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.block-grade.create');
    }

    /**
     * Store a newly created BlockGrade in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        BlockGrade::create($requestData);

        return redirect('/block-grade');
    }

    /**
     * Display the BlockGrade.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $blockgrade = BlockGrade::findOrFail($id);

        return view('backend.block-grade.show', compact('blockgrade'));
    }

    /**
     * Show the form for editing the BlockGrade.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $blockgrade = BlockGrade::findOrFail($id);

        return view('backend.block-grade.edit', compact('blockgrade'));
    }

    /**
     * Update the BlockGrade in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $blockgrade = BlockGrade::findOrFail($id);
        $blockgrade->update($requestData);

        return response()->json(['status' => $blockgrade]); 
    }

    /**
     * Remove the BlockGrade from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        BlockGrade::destroy($id);

        return redirect('/block-grade');
    }
}
