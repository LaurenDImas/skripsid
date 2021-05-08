<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use DataTables;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static $pageTitle        ='Role';
    public static $modelName        ='Spatie\Permission\Models\Role';
    public static $folderPath       ='roles';
    public static $permissionName   ='role';

    function __construct()
    {
         $this->middleware('permission:'.self::$permissionName.'-list|'.self::$permissionName.'-create|'.self::$permissionName.'-edit|'.self::$permissionName.'-delete', ['only' => ['index','store']]);
         $this->middleware('permission:'.self::$permissionName.'-create', ['only' => ['create','store']]);
         $this->middleware('permission:'.self::$permissionName.'-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:'.self::$permissionName.'-delete', ['only' => ['destroy']]);
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
                'name'
            );
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                        $btn = '
                            <div class="dropdown dropdown-inline">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
                                    <i class="la la-cog"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="nav nav-hoverable flex-column">
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/'. $row->id .'/edit"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="'.self::$folderPath.'/'. $row->id .'"><i class="nav-icon la la-search"></i><span class="nav-text">Detail</span></a></li>
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
            $permissions    = self::$permissionName;   
            return view(self::$folderPath . '.index', compact('pageTitle', 'pageDescription', 'pageBreadCrumbs', 'permissionName','permissions'));
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get(); 
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Add Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];
        $permissionName = self::$folderPath;
        return view('roles.create',compact('permission','pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
            
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = self::$modelName::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        // dd($rolePermissions);
        $page_title = self::$pageTitle;
        $pageDescription = self::$pageTitle.' Detail Data';
        $page_breadcrumbs = [
            url(self::$folderPath.'/') => "List ".self::$pageTitle,
            url(self::$folderPath.'/show') => $pageDescription
        ];
        $permissionName = self::$folderPath;
        return view('roles.show',compact('role','rolePermissions','page_title', 'pageDescription', 'page_breadcrumbs', 'permissionName'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = self::$modelName::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' Edit Data';
        $page_breadcrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle,
            url(self::$folderPath . '/create') => $pageDescription
        ];

        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.edit', compact('pageTitle', 'pageDescription', 'page_breadcrumbs', 'permissionName','role','permission','rolePermissions'));
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
            'permission' => 'required',
        ]);
    
        $role = self::$modelName::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
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
            $delete = self::$modelName::find($id);
            $delete->delete();
        } catch (\Throwable $th) {
            return response()->json(['response' => 500, $th]);
        }
        return response()->json(['response' => 200]);
    }
}