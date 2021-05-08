<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\ScheduleActivity;
use App\Application;
use App\User;
use App\NewAssignmentEmployee;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Auth;
use DB;
use Hash;
use DataTables;

    
class ScheduleActivityController extends Controller
{
    public static $pageTitle        ='Schdeule Activity';
    public static $modelName        ='App\ScheduleActivity';
    public static $folderPath       ='schedule_activities';
    public static $permissionName   ='schedule-activity';

    function __construct()
    {
        $this->middleware('permission:'.self::$permissionName.'-list|'.self::$permissionName.'-create|'.self::$permissionName.'-edit|'.self::$permissionName.'-delete', ['only' => ['index','store']]);
        $this->middleware('permission:'.self::$permissionName.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.self::$permissionName.'-edit', ['only' => ['edit','update']]);
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
            $data = self::$modelName::with(['application','application.project','user'])->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'schedule_activities.*'
            )->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    if(Auth::user()->role_id == 4){
                        $btn =  '<li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . $row->id . '/edit"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . $row->id . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
                                    <li class="nav-item"><a class="nav-link btn-delete-record" href="javascript:;" data-url="' . self::$folderPath . '/' . $row->id . '"><i class="nav-icon la la-trash "></i><span class="nav-text">Delete</span></a></li>';
                    }else{
                        $btn =  '<li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . $row->id . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>';

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
            // dd(2);
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
        $data = ScheduleActivity::all();
        $pageTitle = self::$pageTitle;
        $pageDescription = 'Add ' .self::$pageTitle;
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
        // dd($request->all());
        $request->validate([
            'project_id' => 'required',
            'application_id' => 'required',
        ]);
        if($request->hasFile('file')){
            foreach($request->file('file') as $image){
                
                $fileName   = rand(0,100000) . '.' . $image->getClientOriginalName();
                $name = $image->storeAs('assets/Employee', $fileName,'public');
                $data[] = $name;
            }
        }else{
            $data[] = "";
        }  
        $upload                 = new ScheduleActivity;
        $upload->date           =date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $upload->project_id     = $request->project_id;
        $upload->application_id = $request->application_id;
        $upload->activity       = $request->activity;
        $upload->constraint     = $request->constraint;
        $upload->note           = $request->note;
        if(!empty($request->new_assignment_id )){
            $upload->new_assignment_id           = $request->new_assignment_id;
        }
        $upload->status           = ($request->status == null) ? 0 : $request->status;
        $upload->hour_start     = date("h:i:s", strtotime( $request->hour_start ));
        $upload->hour_end       = date("h:i:s", strtotime( $request->hour_end ));
        $upload->file           = json_encode($data);
        $upload->save();
        
        if ($request->ajax()) {
            return response()->json([
                'data' => $upload,
            ]);
        }else{
            return redirect()->route(self::$folderPath.'.index')
                            ->with('success','Schedule Activity created successfully');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = self::$modelName::with(['application','application.project'])->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'schedule_activities.*'
            )->first();
        

        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Detail Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.show', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','data'));
    }

    public function deleteGallery(Request $request,$photoid,$id){
        // dd($id);
        $data = self::$modelName::findOrFail($id);
        $photo = json_decode($data->file);
        // dd($photoid);
        foreach($photo as $key => $value) {
            if(basename($value) == $photoid) { 
                // dd($photo);
                unset($photo[$key]);
            }
        }
        $simple_array = array_values($photo);
        $json = json_encode($simple_array);
        $data->update([
            'file' => $json
        ]);
        Storage::delete('public/assets/NewAss/'.$photoid);
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {   
        $project = Project::pluck('name','id')->all();
        $application = Application::pluck('name','id')->all();
        $user = User::where('role_id',4)->get();
        $data = self::$modelName::find($id);

        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Edit Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
     
        return view(self::$folderPath . '.edit', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','data','project','user','application'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'project_id' => 'required',
            'application_id' => 'required',
        ]);
        $input = $request->all();
        if($request->hasFile('file')){
            foreach($request->file('file') as $image){
                
                $fileName   = rand(0,100000) . '.' . $image->getClientOriginalName();
                $name = $image->storeAs('assets/NewAss', $fileName,'public');
                $output[] = $name;
            }
        }
        if(!empty($output) && !empty($input['file_hidden'])){
            $output = array_merge($output, $input['file_hidden']);
        }else{
            $output = $input['file_hidden'];
        }
        $upload                 = self::$modelName::findOrFail($id);
        $upload->date           =date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $upload->project_id     = $request->project_id;
        $upload->application_id = $request->application_id;
        $upload->activity      = $request->activity;
        $upload->constraint     = $request->constraint;
        $upload->note           = $request->note;
        $upload->hour_start     = date("h:i:s", strtotime( $request->hour_start ));
        $upload->hour_end       = date("h:i:s", strtotime( $request->hour_end ));
        $upload->file           = json_encode($output);
        $upload->status           = 1;
        $upload->save();
        if(!empty($upload->new_assignment_id)){
            // dd($upload->new_assignment_id);
            $data1 = NewAssignmentEmployee::select('id')->where([
                ['user_id',Auth::user()->id],
                ['new_assignment_id', $upload->new_assignment_id]
            ])->first();
            return redirect()->to('priorities/'.$data1->id)
                        ->with('success','Schedule Activity updated successfully');
        }else{
            return redirect()->route(self::$folderPath.'.index')
                        ->with('success','Schedule Activity updated successfully');
        }
       
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = self::$modelName::findOrFail($id);
            $photo = json_decode($data->file);
            foreach($photo as $key => $value) {
                Storage::delete('public/assets/NewAss/'.basename($value));
            }
            // die;
            $data->delete();
        } catch (\Throwable $th) {
            return response()->json(['response' => 500, $th]);
        }
        return response()->json(['response' => 200]);
    }
}