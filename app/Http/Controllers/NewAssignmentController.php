<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\NewAssignment;
use App\NewAssignmentEmployee;
use App\Application;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use App\Http\Requests\ApplicationRequest;
use DB;
use Hash;
use DataTables;
use Pusher\Pusher;

    
class NewAssignmentController extends Controller
{
    public static $pageTitle        ='New Assignment';
    public static $modelName        ='App\NewAssignment';
    public static $folderPath       ='new_assignments';
    public static $permissionName   ='new-assignment';

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
            $data = self::$modelName::with(['application','application.project'])->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'new_assignments.*',
                DB::raw('(CASE WHEN assignment = "priority" THEN "Priority" ELSE "New Daily Assessment" END) AS assignment')
            )
            ->orderBy('id','DESC')
            ->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '
                            <div class="dropdown dropdown-inline">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                    <i class="la la-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . $row->id . '/edit"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/' . $row->id . '"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
                                    <li class="nav-item"><a class="nav-link btn-delete-record" href="javascript:;" data-url="' . self::$folderPath . '/' . $row->id . '"><i class="nav-icon la la-trash "></i><span class="nav-text">Delete</span></a></li>
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
        $upload->assignment = $request->assignment;
        $upload->project_id = $request->project_id;
        $upload->application_id = $request->application_id;
        $upload->alarm = date("G:i:s", strtotime( $request->alarm ));
        $upload->file = json_encode($data);
        $upload->save();
        // dd($request->user_id);
        foreach($request->user_id as $key => $r){            
            $saveUser = [
                'user_id'           =>  $r,
                'new_assignment_id' =>  $upload->id
            ];
    
            // $user = User::where([['id','=',$r],['role_id','=',4]])->get();
            // foreach($user as $key => $rr){
            //     $details = [
            //         'title' => 'Hai '. $rr->name,
            //         'body' => 'Silahkan cek aplikasi anda dengan username '. $rr->email .' selamat mengerjakan!!!'
            //     ];
            //     Mail::to($rr->email)->send(new SendMail($details));
            // }
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
    public function show($id)
    {
        $data = self::$modelName::with(['application','application.project'])->select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'new_assignments.*'
            )->first();
        
        $userData = NewAssignmentEmployee::with('user')->where('new_assignment_id',$id)->get();
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Detail Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.show', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','data','userData'));
    }

    public function deleteGallery(Request $request,$photoid,$id){
        // dd($id);
        $data = self::$modelName::findOrFail($id);
        $photo = json_decode($data->file);
        foreach($photo as $key => $value) {
            if(basename($value) == $photoid) { 
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
    public function edit($id)
    {
        $project = Project::pluck('name','id')->all();
        $application = Application::pluck('name','id')->all();
        $user = User::where('role_id',4)->get();
        $data = self::$modelName::find($id);

        $userData = NewAssignmentEmployee::where('new_assignment_id',$id)->get();
        $userId = [];
        foreach($userData as $val){
            $userId[]=$val->user_id;
        }
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Edit Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.edit', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','data','project','user','application','userId'));
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
        $input = $request->all();
        $output = [];
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
        $input['date'] =date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $input['project_id'] = $request->project_id;
        $input['assignment'] = $request->assignment;
        $input['application_id'] = $request->application_id;
        $input['alarm'] = date("G:i:s", strtotime( $request->alarm ));;
        $input['file'] = json_encode($output);  
        $update = self::$modelName::findOrFail($id);
        $update->update($input);
        
        // dd($request->user_id);
        $dataIN=[];
        if(!empty($request->user_id)) {
            foreach($request->user_id as $key => $r){     
                $getData = NewAssignmentEmployee::where([
                    ['new_assignment_id','=',$update->id],
                    ['user_id','=',$r]
                ])->first();
                if(!empty($getData)){
                    $saving= $getData;
                }else{
                    $saving = new NewAssignmentEmployee();
                }
                $saving->user_id                = $r;
                $saving->new_assignment_id      = $update->id;
                $saving->save();
                $dataIN[] = $r;       
            }
        }
        $delete = NewAssignmentEmployee::where('new_assignment_id','=',$update->id)->whereNotIn('user_id',$dataIN);
        $delete->delete();
        // die();
        return redirect()->route('new_assignments.index')
                        ->with('success','New_assignment updated successfully');
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