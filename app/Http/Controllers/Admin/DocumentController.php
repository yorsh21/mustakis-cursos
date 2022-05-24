<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Storage;
use Session;
use Zipper;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Parameter;
use App\Models\User;
use App\Models\Rol;

class DocumentController extends Controller
{
    /**
     * Constructur with roles middleware.
     */
    public function __construct()
    {
        $this->middleware('roles');
    }
    
    /**
     * Display a listing of the Documents.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $documents = Parameter::where('type', 'document')->get();
            return view('backend.document.index', compact('documents'));
        }
        else {
            return redirect()->back();
        }

    }

    /**
     * Display the Documents.
     *
     * @param string $file
     *
     * @return \Illuminate\View\View
     */
    public function show($file)
    {
        $parameter = Parameter::where('key', $file)->first();

        if(!is_null($parameter) && is_file(public_path('documents/') . $parameter->value)){
            return response()->file(public_path('documents/') . $parameter->value);
        }
        else {
            session()->flash('status', 'No se ha encontrado documento para la visualización');
            return redirect()->back();
        }
    }

    /**
     * Download the Document.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function download($id)
    {
        $parameter = Parameter::findOrFail($id);

        if(!is_null($parameter) && is_file(public_path('documents/') . $parameter->value)){
            $extension = explode('.', $parameter->value)[1];
            return response()->download(public_path('documents/') . $parameter->value, $parameter->key . '.' . $extension);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Download backup of the Documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function backup() {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $this->filedirectory();

            $files = glob(public_path('files/*'));
            $name = date("d-m-Y_His") . '.zip' ;
            
            $zipper = new \Chumper\Zipper\Zipper;
            $zipper->make('backups/' . $name )->add($files);
            $zipper->close();

            if(is_file(public_path('backups/') . $name)) {
                return response()->download(public_path('backups/') . $name);
            }
        }
        return redirect()->back();
    }

    /**
     * Destroy all Documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll() {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $files = glob(public_path('files/*'));
            $backups = glob(public_path('backups/*'));

            foreach($files as $file) {
                if(is_file($file))
                    unlink($file);
            }

            foreach($backups as $backup) {
                if(is_file($backup))
                    unlink($backup);
            }

            User::each(function ($item, $key) {
                $item->auth_doc = null;
                $item->school_doc = null;
                $item->auth_doc2 = null;
                $item->school_doc2 = null;
                $item->cession_doc = null;
                $item->license_student = null;
                $item->license_tutor = null;
                $item->recomendation_doc = null;
                $item->course = null;
                $item->save();
            });
        }
        return redirect()->back();
    }

    /**
     * Update the Document in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        if(Auth::user()->rol_id != Rol::ADMIN) {
            return redirect()->back();
        }

        $data = $request->validate([
            'document' => 'file|mimes:pdf,jpeg,png,docx,doc|max:2000',
        ]);

        $document = $request->file('document');

        if ($document != null) {
            $parameter = Parameter::findOrFail($request->id);
            $file_hash = Storage::disk('document')->put('', $document);

            if(is_file(public_path("documents") . "/" . $parameter->value))
                unlink(public_path("documents") . "/" . $parameter->value);
            
            $parameter->value = $file_hash;
            $parameter->save();
            session()->flash('status', 'Documento actualizado exitosamente');
        }

        return redirect()->route('document.index');
    }

    /**
     * Remove the Document from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        if(Auth::user()->rol_id != Rol::ADMIN) {
            return redirect()->back();
        }

        $parameter = Parameter::find($id);

        if(!is_null($parameter) && $parameter->type == "document" && is_file(public_path("documents") . "/" . $parameter->value)) {
            unlink(public_path("documents") . "/" . $parameter->value);
            $parameter->value = "";
            $parameter->save();

            session()->flash('status', 'Documento eliminado exitosamente');
            return redirect()->route('document.index');
        }
        else {
            session()->flash('status', 'No se ha encontrado documento para la eliminación');
            return redirect()->route('document.index');
        }
    }

    /**
     * Create HTML file of directory of the Documents.
     */
    public function filedirectory() {
        $headfile = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Listado de Documentos</title></head><body><h1>Listado de Documentos</h1><table><thead><tr><th>Nombre Alumno</th><th>Tipo de Documento</th><th>Archivo</th></tr></thead><tbody>';
        $footerfile = '</tbody></table></body></html>';

        $htmlfile = fopen(public_path('files/') . "_directorio.html", "w");
        fwrite($htmlfile, $headfile);

        User::all()->each(function ($item, $key) use($htmlfile) {
            if(!is_null($item->auth_doc)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Carta Autorización Apoderados</td>
                        <td><a href="' . $item->auth_doc . '">' . $item->auth_doc . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->school_doc)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Carta de Compromiso Colegios</td>
                        <td><a href="' . $item->school_doc . '">' . $item->school_doc . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->auth_doc2)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Carta Autorización Apoderados Adicional</td>
                        <td><a href="' . $item->auth_doc2 . '">' . $item->auth_doc2 . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->school_doc2)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Carta de Compromiso Colegios Adicional</td>
                        <td><a href="' . $item->school_doc2 . '">' . $item->school_doc2 . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->cession_doc)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Cesión de Imagen</td>
                        <td><a href="' . $item->cession_doc . '">' . $item->cession_doc . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->license_student)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Cédula de identidad del estudiante</td>
                        <td><a href="' . $item->license_student . '">' . $item->license_student . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->license_tutor)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Cédula de identidad del tutor</td>
                        <td><a href="' . $item->license_tutor . '">' . $item->license_tutor . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }

            if(!is_null($item->recomendation_doc)){
                $line = '<tr>
                        <td>' . $item->name . '</td>
                        <td>Carta de Recomendación</td>
                        <td><a href="' . $item->recomendation_doc . '">' . $item->recomendation_doc . '</a></td>
                    </tr>';
                fwrite($htmlfile, $line);
            }
        });
        fwrite($htmlfile, $footerfile);
        fclose($htmlfile);
    }

}
