<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Alarm;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;

use App\Http\Requests\AlarmRequest;
use DB;
use Hash;
use DataTables;

    
class AlarmController extends Controller
{
    public static $pageTitle        ='Alarm';
    public static $modelName        ='App\Alarm';
    public static $folderPath       ='alarms';
    public static $permissionName   ='alarm';

    function __construct()
    {
        $this->middleware('permission:'.self::$permissionName.'-list|', ['only' => ['index','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Alarm::first();

        $pageTitle = self::$pageTitle;
        $pageDescription = self::$pageTitle . ' List Data';
        $pageBreadCrumbs = [
            url(self::$folderPath . '/') => "List " . self::$pageTitle
        ];
        $permissionName = self::$folderPath;
        return view(self::$folderPath . '.index', compact('data','pageTitle', 'pageDescription', 'pageBreadCrumbs', 'permissionName'));
    }

    public function store(Request $request)
    {   
        $input = $request->all();
        $input['alarm']     = date("G:i:s", strtotime( $input['alarm'] ));
        self::$modelName::create($input);
        return redirect()->route('alarms.index')
                        ->with('success','Alarm created successfully');
    }

    
}