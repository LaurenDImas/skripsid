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
            $data = NewAssignmentEmployee::with(['newAssignment','newAssignment.application','newAssignment.application.project'])
            ->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'new_assignment_employees.*'
            )->get();
            if(Auth::user()->role_id != 3){
                $data = $data->where('user_id',Auth::user()->id);
            }
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                            <div class="dropdown dropdown-inline">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                    <i class="la la-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . $row->id . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::pluck('name','id')->all();
        $user = User::where('role_id',4)->get();
        $data = NewAssignment::all();
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Add Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.create', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName', 'project','data','user'));

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        if($request->hasFile('file')){
            foreach($request->file('file') as $image){
                
                $fileName   = rand(0,100000) . '.' . $image->getClientOriginalName();
                $name = $image->storeAs('assets/NewAss', $fileName,'public');
                $data[] = $name;
            }
        }else{
            $data[] = "";
        }  
        $upload = new NewAssignment;
        $upload->date =date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $upload->project_id = $request->project_id;
        $upload->application_id = $request->application_id;
        $upload->alarm = date("h:i:s", strtotime( $request->alarm ));
        $upload->file = json_encode($data);
        $upload->save();
        // dd($request->user_id);
        foreach($request->user_id as $key => $r){            
            $saveUser = [
                'user_id'           =>  $r,
                'new_assignment_id' =>  $upload->id
            ];
    
            $user = User::where([['id','=',$r],['role_id','=',4]])->get();
            foreach($user as $key => $rr){
                $details = [
                    'title' => 'Tes Ngirim Email Skripsi',
                    'body' => 'lorem'
                ];
                Mail::to($rr->email)->send(new SendMail($details));
            }
            NewAssignmentEmployee::create($saveUser);
        }
        
        return redirect()->route('new_assignments.index')
                        ->with('success','New_assignment created successfully');
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
            $str = str_replace('show','',$id);
            DB::statement(DB::raw('set @rownum=0'));
            $data1 = ScheduleActivity::with(['application','application.project','user'])->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'schedule_activities.*'
            )
            ->where([
                ['created_by',Auth::user()->id],
                ['new_assignment_id', $str]
            ])
            ->get();
            return Datatables::of($data1)
                ->addColumn('action', function ($row) {
                    if(Auth::user()->role_id == 4){
                        $btn =  '<li class="nav-item"><a class="nav-link"  href="../schedule_activities/' . $row->id . '/edit"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
                                    <li class="nav-item"><a class="nav-link" target="_BLANK" href="../schedule_activities/' . $row->id . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
                                    <li class="nav-item"><a class="nav-link btn-delete-record" href="javascript:;" data-url="../schedule_activities/' . $row->id . '"><i class="nav-icon la la-trash "></i><span class="nav-text">Delete</span></a></li>';
                    }else{
                        $btn =  '<li class="nav-item"><a class="nav-link" target="_BLANK" href="../schedule_activities/' . $row->id . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>';
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
            $data = $this->assigmentEmployee($id);
            // dd($data);
            $userData = NewAssignmentEmployee::with('user')->where('id',$id)->first();
            
            
            $pageTitle = self::$pageTitle;
            $pageDescription = self::$pageTitle . ' Detail Data';
            $page_breadcrumbs = [
                url(self::$folderPath . '/') => "List " . self::$pageTitle,
                url(self::$folderPath . '/create') => $pageDescription
            ];
            $edit = "";
            $permissionName = self::$folderPath;
            return view(self::$folderPath . '.show', compact('pageTitle','edit', 'pageDescription', 'page_breadcrumbs', 'permissionName','data','userData'));
        }
    }

    private function assigmentEmployee($id){
        
        $data = NewAssignmentEmployee::with(['newAssignment','newAssignment.application','newAssignment.application.project'])
        ->select(
            DB::raw('@rownum := @rownum +1 as rownum'),
            'new_assignment_employees.*'
        )->where('id',$id)->first();

        return $data;
    }
    
}