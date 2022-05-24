<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Questionary;

class BlockController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Blocks.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.index');
    }

    /**
     * Show the form for creating a new Block.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $questionnaires = Questionary::all();

        return view('backend.block.create', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new Block.
     *
     * @return \Illuminate\View\View
     */
    public function create_from_school($school_id)
    {
        $questionnaires = Questionary::all();

        return view('backend.block.create', compact('school_id', 'questionnaires'));
    }

    /**
     * Store a newly created Block in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Block::create($requestData);
        $url = session('current_path_school') . "/" . session('current_item_school');

        return redirect($url);
    }

    /**
     * Display Blocks.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $block = Block::findOrFail($id);
        if($block->questionnaire_id == 0)
            $questionary = [];
        else
            $questionary = json_decode(Questionary::find($block->questionnaire_id));
        session(['current_path_block' => 'block']);
        session(['current_item_block' => $id]);

        return view('backend.block.show', compact('block', 'questionary'));
    }

    /**
     * Show the form for editing Blocks.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $block = Block::findOrFail($id);
        $questionnaires = Questionary::all();

        return view('backend.block.edit', compact('block', 'questionnaires'));
    }

    /**
     * Update Blocks in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $block = Block::findOrFail($id);
        $block->update($requestData);
        $url = session('current_path_school') . "/" . session('current_item_school');

        return redirect($url);
    }

    /**
     * Remove Blocks from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Block::destroy($id);

        return redirect()->back();
    }
}
