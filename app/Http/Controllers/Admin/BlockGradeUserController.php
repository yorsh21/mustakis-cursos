<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlockGradeUser;

class BlockGradeUserController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the BlockGradeUsers.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $blockgradeuser = BlockGradeUser::all();

        return view('backend.block-grade-user.index', compact('blockgradeuser'));
    }

    /**
     * Show the form for creating a new BlockGradeUser.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.block-grade-user.create');
    }

    /**
     * Store a newly created BlockGradeUser in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        BlockGradeUser::create($requestData);

        return redirect('/block-grade-user');
    }

    /**
     * Display the BlockGradeUser.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $blockgradeuser = BlockGradeUser::findOrFail($id);

        return view('backend.block-grade-user.show', compact('blockgradeuser'));
    }

    /**
     * Show the form for editing the BlockGradeUser.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $blockgradeuser = BlockGradeUser::findOrFail($id);

        return view('backend.block-grade-user.edit', compact('blockgradeuser'));
    }

    /**
     * Update the BlockGradeUser in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $blockgradeuser = BlockGradeUser::findOrFail($id);
        $blockgradeuser->update($requestData);

        return redirect('/block-grade-user');
    }

    /**
     * Remove the BlockGradeUser from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        BlockGradeUser::destroy($id);

        return redirect('/block-grade-user');
    }
}
