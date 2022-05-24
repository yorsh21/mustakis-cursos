<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Material;

class MaterialController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Material.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.index');
    }

    /**
     * Show the form for creating a new Material.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.material.create');
    }

    /**
     * Show the form for creating a new Material.
     *
     * @return \Illuminate\View\View
     */
    public function create_from_block($block_id)
    {
        return view('backend.material.create', compact('block_id'));
    }

    /**
     * Store a newly created Material in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'file' => 'required|max:16000',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_hash = Storage::disk('public')->put('', $file);
        }
        else {
            return redirect()->back();
        }

        Material::create([
            "name" => $request->name,
            "general" => $request->general,
            "block_id" => $request->block_id,
            "file" => $file_hash,
        ]);

        $url = session('current_path_block') . "/" . session('current_item_block');

        return redirect($url);
    }

    /**
     * Display the Material.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $material = Material::findOrFail($id);

        return view('backend.material.show', compact('material'));
    }

    /**
     * Show the form for editing the Material.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id);

        return view('backend.material.edit', compact('material'));
    }

    /**
     * Update the Material in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_hash = Storage::disk('public')->put('', $file);

            $old_file = 'files/' . $material->file;
            if(file_exists($old_file)){
                unlink($old_file);
            }
            
            $material->update([
                "name" => $request->name,
                "general" => $request->general,
                "block_id" => $request->block_id,
                "file" => $file_hash,
            ]);
        }
        else {
            $material->update([
                "name" => $request->name,
                "general" => $request->general,
                "block_id" => $request->block_id,
            ]);
        }
        
        $url = session('current_path_block') . "/" . session('current_item_block');

        return redirect($url);
    }

    /**
     * Remove the Material from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $file = 'files/' . $material->file;

        if(file_exists($file)){
            unlink($file);
        }

        Material::destroy($id);

        return redirect()->back();
    }

    /**
     * Remove the Material from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function download_file($id)
    {
        $material = Material::findOrFail($id);
        $extension = explode( '.', $material->file)[1];
        $file = public_path('files/') . $material->file;

        if(file_exists($file)){
            return \Response::download($file, $material->name . '.' . $extension);
        }
        else {
            Session::flash('message', 'El archivo que intenta descargar no se encuentra disponible.');
            return redirect()->back();
        }
    }
}
