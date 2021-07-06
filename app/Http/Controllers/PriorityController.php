<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\NewAssignment;
use App\NewAssignmentEmployee;
use App\Application;
use App\User;
use App\Priority;
use App\ScheduleActivity;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use App\Http\Requests\ApplicationRequest;
use DB;
use Hash;
use DataTables;
use Auth;
use Crypt;

    
class PriorityController extends Controller
{
    public static $pageTitle        ='Priority';
    public static $modelName        ='App\NewAssignment';
    public static $folderPath       ='priorities';
    public static $permissionName   ='priority';

    function __construct()
    {
        $this->middleware('permission:'.self::$permissionName.'-list|'.self::$permissionName.'-show|'.self::$permissionName.'-edit|'.self::$permissionName.'-delete', ['only' => ['index','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = NewAssignmentEmployee::with(['user','newAssignment.application','newAssignment.application.project'])
            ->join('new_assignments','new_assignments.id','new_assignment_employees.new_assignment_id')
            ->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'new_assignment_employees.*',
                'new_assignments.*'
            );
            if(Auth::user()->role_id != 3){
                $data = $data->where([
                    ['user_id',"=",Auth::user()->id],
                ]);
            }
            $data = $data->where([
                ["assignment","=","priority"],
                ["new_assignments.status","=",1]
            ]);
            $data = $data->orderBy(DB::raw('ABS(DATEDIFF(new_assignments.date, NOW()))'))->get()->toArray();
            // dd($data);
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                            <div class="dropdown dropdown-inline">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                    <i class="la la-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . Crypt::encrypt($row['id']) . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
                                </ul>
                                </div>
                            </div>
                        ';
                    // dd($row->id);
                    return $btn;
                })
                ->make(true);
        }else{
            $pageTitle = self::$pageTitle;
            $pageDescription = self::$pageTitle . ' List Data';
            $pageBreadCrumbs = [
                url(self::$folderPath . '/') => "List " . self::$pageTitle
            ];
            $permissionName = self::$folderPath;
            return view(self::$folderPath . '.index', compact('pageTitle', 'pageDescription', 'pageBreadCrumbs', 'permissionName'));
        }
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data1 = ScheduleActivity::with(['application','application.project','user'])->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'schedule_activities.*',
                'new_assignments.assignment'
            )->join('new_assignments','new_assignments.id','schedule_activities.new_assignment_id');
            $data1 = $data1->where([
                ['schedule_activities.created_by',$request->user_id]
            ]);
            $data1 = $data1->where([
                ['schedule_activities.new_assignment_id', $request->new_assignment_id]
            ]);
            $data1 = $data1->get();
            return Datatables::of($data1)
                ->addColumn('action', function ($row) {
                    if($row->assignment == "new"){
                        $link = "schedule_activities";
                    }else{
                        $link = "priorities";
                    }
                    if(Auth::user()->role_id == 4){
                        $btn =  '<li class="nav-item"><a class="nav-link"  href="../'.$link.'/' . Crypt::encrypt($row->id) . '/edit"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit</span></a></li>
                                    <li class="nav-item"><a class="nav-link"  href="../'.$link.'/show/' . Crypt::encrypt($row->id) . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
                                    <li class="nav-item"><a class="nav-link btn-delete-record" href="javascript:;" data-url="../schedule_activities/delete/' . Crypt::encrypt($row->id) . '"><i class="nav-icon la la-trash "></i><span class="nav-text">Delete</span></a></li>';
                    }else{
                        $btn =  '<li class="nav-item"><a class="nav-link"  href="../'.$link.'/show/' . Crypt::encrypt($row->id) . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>';
                    }
                    $btn = '
                            <div class="dropdown dropdown-inline">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                    <i class="la la-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                   '. $btn.'
                                </ul>
                                </div>
                            </div>
                        ';
                    // dd($row->id);
                    return $btn;
                })
                ->make(true);
        }else{
            
            $id = Crypt::decrypt($id);
            $items = [
                "new"=>    "Schdeule Activity",
                "priority"=> "Priority Assignments"
            ];
            $data = $this->assigmentEmployee($id);
            $pageDescription = $items[$data->newAssignment->assignment];
            $page_breadcrumbs = [
                url(self::$folderPath . '/') => "List " . $items[$data->newAssignment->assignment],
                url(self::$folderPath . '/create') => $pageDescription
            ];
            $edit = "";
            
            if($items[$data->newAssignment->assignment] == "Priority Assignments"){
                $permissionName = self::$folderPath;
            }else{
                $permissionName = "schedule_activities";
            }
            return view(self::$folderPath . '.show', compact('edit', 'pageDescription', 'page_breadcrumbs', 'permissionName','data'));
        }
    }

    public function assigmentEmployee($id){
        
        $data = NewAssignmentEmployee::with(['newAssignment','newAssignment.application','newAssignment.application.project','user'])
        ->where('id',$id)->first();

        return $data;
    }
    
}