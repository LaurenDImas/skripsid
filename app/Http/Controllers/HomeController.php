<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewAssignment;
use App\NewAssignmentEmployee;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = NewAssignment::select([
            DB::raw("SUM(CASE 
                WHEN assignment = 'new' AND status = 0 THEN 1 ELSE 0 END) AS new_hold"),
            DB::raw("SUM(CASE 
                WHEN assignment = 'new' AND status = 1 THEN 1 ELSE 0 END) AS new_progress"),
            DB::raw("SUM(CASE 
                WHEN assignment = 'new' AND status = 2 THEN 1 ELSE 0 END) AS new_completed"),
                
            DB::raw("SUM(CASE 
                WHEN assignment = 'priority' AND status = 0 THEN 1 ELSE 0 END) AS priority_hold"),
            DB::raw("SUM(CASE 
                WHEN assignment = 'priority' AND status = 1 THEN 1 ELSE 0 END) AS priority_progress"),
            DB::raw("SUM(CASE 
                WHEN assignment = 'priority' AND status = 2 THEN 1 ELSE 0 END) AS priority_completed"),
        ])->first();
        
        if ($request->ajax()) {
            $assignment = NewAssignment::join('projects','projects.id','=','new_assignments.project_id')
                        ->join('applications','applications.id','=','new_assignments.application_id')
                        ->select([
                            'new_assignments.id',
                            'date',
                            'assignment as assignment',
                            'applications.name as application',
                            'projects.name as project',
                            'new_assignments.status as status',
                        ])
                        ->get();
                        
            $arr = [];

            $color = ['danger','warning','success'];
            $NewAssignmentEmployee = NewAssignmentEmployee::join('users','users.id','=','new_assignment_employees.user_id')
                ->select([
                    'new_assignment_employees.new_assignment_id',
                    'users.name'
                ])
                ->get()
                ->toArray();
            $user=[];
            foreach($NewAssignmentEmployee as $Key => $r){
                $user[$r['new_assignment_id']][]=$r['name'];
            }
            foreach($assignment as $key => $r){
                $status =  ($r->assignment == "new") ? "Daily Assignment" : "Priority";
                $arr[$key]=[
                    "title"       => $r->project ." - ". $r->application,
                    "start"       => $r->date,
                    "description" => 'Programmer : '. str_replace('"','', json_encode(implode(', ', $user[$r->id]))),
                    "className"   => "fc-event-default fc-event-solid-".$color[$r->status].""
                ];
            }
            return [ 'data'=>$arr];
            
        }

        return view('dashboards.index',compact('data'));
    }
}
