<?php
namespace App\Http\Controllers;
use DB;
use PDF;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportUserController extends Controller
{
    public static $pageTitle        ='User';
    public static $modelName        ='App\User';
    public static $folderPath       ='report_user';
    public static $permissionName   ='user';

    public function index(Request $req)
    {
        $method = $req->method();

        if ($req->isMethod('post'))
        {
            $from = $req->input('from');
            $to   = $req->input('to');
            $ViewsPage = DB::select("SELECT * FROM users WHERE created_at BETWEEN '$from' AND '$to'");
            if ($req->has('search')){
                return view(self::$folderPath . '.report_pdf',compact('ViewsPage'));
            }elseif ($req->has('exportPDF')){
                $pdf = PDF::loadView(self::$folderPath . '.report_pdf', ['ViewsPage' => $ViewsPage])
                        ->setPaper('a4', 'landscape');
                return $pdf->stream('whateveryourviewname.pdf');
            }elseif($req->has('exportExcel')){
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'Hello World !');

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="DATA PENDATAAN.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
            }
        }else{
            $pageTitle = self::$pageTitle;
            $pageDescription = self::$pageTitle . ' Report';
            $pageBreadCrumbs = [
                url(self::$folderPath . '/') => "List " . self::$pageTitle
            ];
            $permissionName = self::$folderPath;//select all
            return view(self::$folderPath . '.index', compact('pageTitle', 'pageDescription', 'pageBreadCrumbs', 'permissionName'));
        }
    }
}