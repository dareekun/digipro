<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\FinishProduction;
use App\Exports\ProductionData;
use App\Exports\TransfersRecord;

use App\User;
Use Redirect;
use Auth;

use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index() {
        return redirect(route('dashboard'));
     }

    public function dashboard()
    {   
        $record = DB::table('production')->leftJoin('product', 'product.id', '=', 'production.model_no')->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->select('production.lotno as lotno', 'production.shift as shift', 'product.model_no as model_no', 'production.fg_1 as finish_goods', 'production.ng_1 as not_goods', 'production.name_1 as pic', 'production.status as status',
        'quality.judgement as judgement')->where('production.status', '<', 99)->get();
        return view('dashboard', ['data' => $record]);
    }

    public function change_password() {
        return view('control.change_password');
    }

    public function lotcard_status() 
    {    
        $product = DB::table('product')->select('id', 'model_no')->get();
        $record  = DB::table('production')->where('status', 0)->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift',  'product.model_no as model_no', 
        'production.fg_1 as finish_goods', 'production.ng_1 as no_goods', 'production.name_1 as pic', 'production.status as status')
        ->get();
        return view('lotcard_status', ['data' => $record, 'products' => $product]);
    }
    public function production_data() 
    {
        $record = DB::table('production')->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift', 'product.model_no as model_no', 'production.fg_1 as finish_goods',
        'production.status as status', 'production.ng_1 as not_goods', 'production.name_1 as pic', 'quality.judgement as judgement')->where('production.status', '<', 99)->get();
        return view('production_data', ['data' => $record]);
    }
    public function in_production() 
    {
        $record = DB::table('production')->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->leftJoin('users', 'quality.userId', '=', 'users.id')->leftJoin('product', 'production.model_no', '=', 'product.id')->where('production.status', 0)
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift', 'product.model_no as model_no', 'production.fg_1 as finish_goods',
        'production.name_1 as pic', 'product.line as line')->where('production.status', '<', 99)->get();
        return view('in_production', ['data' => $record]);
    }
    public function finish_data() 
    {
        $record = DB::table('production')->where('production.status', '>', 0)->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->leftJoin('product', 'product.id', '=', 'production.model_no')
        ->select('production.barcode as id', 'product.section as section', 'product.line as line', 'product.model_no as model_no',
        'production.lotno as lotno', 'production.shift as shift', 'production.fg_1 as finish_goods', 'production.id as proid',
        'quality.judgement as judgement', 'quality.userId as checker')->get();
        return view('finish_data', ['data' => $record]);
    }

    public function later_input() 
    {    
        return view('later_inspection');
    }

    public function inspection_detail($id) {

    }
    public function transaction_data() 
    {
        $record = DB::table('production')->where('status', 2)->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->select(
            'production.lotno as lotno', 'production.shift as shift', 'product.model_no as model_no', 'production.fg_1 as fg_1', 
            'production.ng_1 as ng_1', 'production.name_1 as name_1', 'quality.judgement as judgement'
        )->get();
        return view('transaction_data', ['data' => $record]);
    }
    public function transfers_records()
    {
        $record = DB::table('transfers')->orderBy('transfers_date', 'desc')->get();
        return view('transfers_records', ['data' => $record, 'i' => 1]);
    }
    public function transfers_details($id) {

    }

    public function download_data($id) {
        if ($id == 'finish_production') {
            return Excel::download(new FinishProduction, 'Export Finish Data Production '.date('Y-m-d').'.xlsx');
        } elseif ($id == 'production_data') {
            return Excel::download(new ProductionData, 'Export Production Data History '.date('Y-m-d').'.xlsx');
        } else if ($id == 'transfers_record') {
            return Excel::download(new TransfersRecord, 'Export Transfers Data Records '.date('Y-m-d').'.xlsx');
        } else {
            return "Error Data Not Found";
        }
    }

    public function process_quality($id) {
        $record = DB::table('production')->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->select('production.barcode as barcode', 'production.lotno as lotno', 'production.shift as shift', 'production.fg_1 as lot_size', 'quality.userId as checker',
        'production.fg_2 as total_box', 'product.model_no as model_no', 'product.section as section', 'product.line as line', 'product.packing as packing')
        ->where('production.barcode', $id)->get();
        return view('process_quality', ['data' => $record]);
    }

    public function modify_quality($id) {
        $product = DB::table('product')->select('id', 'model_no')->get();
        $record = DB::table('production')->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->select('production.barcode as barcode', 'production.lotno as lotno', 'production.shift as shift', 'production.fg_1 as lot_size', 'quality.remark as remark',  'quality.userId as checker',
        'production.model_no as model_id', 'product.id as product_id',
        'quality.judgement as judgement', 'production.fg_2 as total_box', 'product.model_no as model_no', 'product.section as section', 'product.line as line', 'product.packing as packing')
        ->where('production.barcode', $id)->get();
        return view('modify_quality', ['data' => $record, 'products' => $product]);
    }

}
