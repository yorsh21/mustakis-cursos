<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Questionary;
use App\Models\Survey;
use App\Models\Rol;
use App\Models\Period;
use App\Models\Campus;
use App\Models\Grade;
use App\Models\Postulation;
use App\Models\Answer;

class StatisticsController extends Controller
{
    /**
     * Show Stats.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function assistance()
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $periods = Period::all();
            $campus = Campus::all();
        }
        elseif(Auth::user()->rol_id == Rol::COORDINADOR) {
            $periods = Period::all();
            $campus = Campus::where('user_id', Auth::user()->id)->get();
        }
        else {
            return redirect()->back();
        }

        return view('backend.statistics.assistance', compact('periods', 'campus'));
    }


    /**
     * Filter Assistances.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function filter_assistance(Request $request)
    {
        if(!$request->ajax()) {
            return redirect()->back();
        }

        $filter_campus = [];
        $grade = [];
        $total = [];
        $attendance = [];
        
        if(Auth::user()->rol_id == Rol::ADMIN) {
            if(!is_null($request->campus)) {
                $filter_campus = [$request->campus];
            }
            else {
                $filter_campus = Campus::all()->pluck(['id'])->toArray();
            }
        }
        else if(Auth::user()->rol_id == Rol::COORDINADOR) {
            $ides = Campus::where("user_id", Auth::user()->id)->get()->pluck(['id'])->toArray();
            if(!is_null($request->campus) && in_array($request->campus, $ides)) {
                $filter_campus = [$request->campus];
            }
            else {
                $filter_campus = $ides;
            }
        }

        if(is_null($request->period)) {
            Grade::whereIn("campus_id", $filter_campus)->each(function ($item) use(&$grade, &$total, &$attendance) {
                $total_attendance = 0;
                $up_attendance = 0;

                if(!$item->archived) {
                    $item = $item->update_open_courses();
                }
    
                foreach ($item->division_users as $division_user) {
                    if ($division_user->rol == Rol::ALUMNO) {
                        $total_attendance += 1;
                        if($division_user->attendance_percentage >= 62) {
                            $up_attendance += 1;
                        }
                    }
                }
                array_push($grade, $item->type);
                array_push($total, $total_attendance);
                array_push($attendance, $up_attendance);                
            });
        }
        else {
            Grade::whereIn("campus_id", $filter_campus)->where("period_id", $request->period)->each(function ($item) use(&$grade, &$total, &$attendance) {
                $total_attendance = 0;
                $up_attendance = 0;

                if(!$item->archived) {
                    $item = $item->update_open_courses();
                }
    
                foreach ($item->division_users as $division_user) {
                    if ($division_user->rol == Rol::ALUMNO) {
                        $total_attendance += 1;
                        if($division_user->attendance_percentage >= 62) {
                            $up_attendance += 1;
                        }
                    }
                }

                array_push($grade, $item->type);
                array_push($total, $total_attendance);
                array_push($attendance, $up_attendance);                
            });
        }

        return response()->json([$grade, $total, $attendance]); 
    }

    
    /**
     * Remove the Postulation from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postulation()
    {
        if(Auth::user()->rol_id == Rol::ADMIN) {
            $periods = Period::all()->reverse();
        }
        else {
            return redirect()->back();
        }

        return view('backend.statistics.postulation', compact('periods'));
    }


    /**
     * Filter Postulation.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|JSON
     */
    public function filter_postulation(Request $request)
    {
        if(!$request->ajax()) {
            return redirect()->back();
        }

        $sedes = [];
        $total_approve = [];
        $total_reprobate = [];

        Campus::all()->each(function ($campus) use(&$sedes, &$total_approve, &$total_reprobate)  {
            $sedes[$campus->commune_id] = $campus->name;
            $total_approve[$campus->commune_id] = 0;
            $total_reprobate[$campus->commune_id] = 0;
        });

        Postulation::where("period_id", $request->period)->each(function ($item) use(&$sedes, &$total_approve, &$total_reprobate) {
            foreach ($item->solicitudes as $solicitude) {
                if($solicitude->status == "aprobada") {
                    $total_approve[$solicitude->user->city_assist_workshop]++;
                }
                else {
                    $total_reprobate[$solicitude->user->city_assist_workshop]++;
                }
            }
        });

        return response()->json([array_values($sedes), array_values($total_approve), array_values($total_reprobate)]); 
    }
    
}
