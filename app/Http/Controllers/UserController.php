<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;
use DB;
use Hash;
use DataTables;
use Auth;
use App\Forum;
    
class UserController extends Controller
{
    public static $pageTitle        ='User';
    public static $modelName        ='App\User';
    public static $folderPath       ='users';
    public static $permissionName   ='user';

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
            $data = self::$modelName::select(
                DB::raw('@rownum := @rownum +1 as rownum'),
                'id',
                'name',
                'status',
                'email'
            );
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
        $roles = Role::pluck('name','name')->all();
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Add Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.create', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName', 'roles'));

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric',
            'photo' => 'mimes:jpg,bmp,png|max:5024',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
            
        $input = $request->all();
        $roles = Role::where('name',$input['roles'])->first();
        $input['photo'] = $request->file('photo')->store('assets/user','public');
        $input['role_id'] = $roles->id;
        $input['password'] = Hash::make($input['password']);
        $user = self::$modelName::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = self::$modelName::find($id);
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Detail Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.show', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','data'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = self::$modelName::find($id);
        // dd($user);
        $roles = Role::pluck('name','name')->all();
        $userRole = $data->roles->pluck('name','name')->all();
    
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Edit Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.edit', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','data','userRole','roles'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $roles = Role::where('name',$input['roles'])->first();
        $input['role_id'] = $roles->id;
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
    
        $user = self::$modelName::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
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
            $forum = Forum::where('created_by',$id);
            $forum->delete();
            $delete = self::$modelName::find($id);
            $delete->delete();
        } catch (\Throwable $th) {
            return response()->json(['response' => 500, $th]);
        }
        return response()->json(['response' => 200]);
    }
}