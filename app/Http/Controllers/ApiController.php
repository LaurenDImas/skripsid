<?php

namespace App\Http\Controllers;
use App\Application;
use Illuminate\Http\Request;
use App\ScheduleActivity;
use App\NewAssignmentEmployee;
use App\NewAssignment;

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
        $status->update($input); 
       
        return response()->json([
            'data' => $status,
        ]);
    }
    
    public function statusAssignment(Request $request){
        $input = $request->all();
        if($input['type'] == 0){
            $input['assignment'] = $input['status'];
            unset($input['status']);
        }else{
            $input['status'] = $input['status'];
        }
        // dd($input);
        $status = NewAssignment::find($input['id']);
        // dd($status);
        $status->update($input); 
        return response()->json([
            'data' => $status,
        ]);
    }
}
