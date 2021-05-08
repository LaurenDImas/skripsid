<?php

namespace App\Http\Controllers;
use App\Application;
use Illuminate\Http\Request;
use App\ScheduleActivity;
use App\NewAssignmentEmployee;

class ApiController extends Controller
{
    
    public function application(Request $request,$id){
        $data = Application::where('project_id',$id)->get();
        $results = [];
        $a =0;
        foreach($data as $key => $val){
            $results[$a]['id'] = $val->id;
            $results[$a]['text'] = $val->name;
            $a++;
        } 
        return response()->json([
            'data' => $results,
        ]);
    }

    
    public function statusAss(Request $request){
        $input = $request->all();
        $input['status'] = $input['status'];
        $status = ScheduleActivity::find($input['id']);
        if(!empty($input['new_assignment_id'])){
            $save = [];
            $save["status"] = $request["status"];
            $status_ass = NewAssignmentEmployee::where([['new_assignment_id','=',$input['new_assignment_id']],['user_id','=',$input['user_id']]]);
            $status_ass->update($save);
        }
        // dd($status);
        $status->update($input); 
       
        return response()->json([
            'data' => $status,
        ]);
    }
}
