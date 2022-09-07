<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

use Illuminate\Support\Facades\Http;

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
        $record = DB::table('production')->orderBy('lotno', 'desc')->get();
        return view('dashboard', ['data' => $record, 'i' => 1]);
    }

    public function change_password() {
        return view('control.change_password');
    }

    public function lotcard_status() 
    {    
        $product = DB::table('product')->select('id', 'model_no')->get();
        $record = DB::table('production')->where('status', '<', 2)->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift',  'product.model_no as model_no', 
        'production.fg_1 as finish_goods', 'production.ng_1 as no_goods', 'production.name_1 as pic', 'production.status as status')
        ->get();
        return view('lotcard_status', ['data' => $record, 'products' => $product, 'i' => 1]);
    }
    public function production_data() 
    {
        $line = DB::table('product')->select('line')->distinct()->get();
        $section = DB::table('product')->select('section')->distinct()->get();
        $record = DB::table('production')->where('status', '>', 0 )->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift', 'production.model_no as model_no', 'production.fg_1 as finish_goods',
        'production.name_1 as pic', 'quality.judgement as judgement', 'production.status as status', 'users.name as checker')->get();
        return view('production_data', ['data' => $record, 'line' => $line, 'section' => $section, 'i' => 1]);
        
    }
    public function in_production() 
    {
        $line = DB::table('product')->select('line')->distinct()->get();
        $section = DB::table('product')->select('section')->distinct()->get();
        $record = DB::table('production')->where('status', 1)->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift', 'production.model_no as model_no', 'production.fg_1 as finish_goods',
        'production.name_1 as pic', 'production.status as status', 'users.name as checker')->get();
        return view('in_production', ['data' => $record, 'line' => $line, 'section' => $section, 'i' => 1]);
    }
    public function finish_data() 
    {
        $line = DB::table('product')->select('line')->distinct()->get();
        $section = DB::table('product')->select('section')->distinct()->get();
        $record = DB::table('production')->where('status', 1)->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->leftJoin('users', 'quality.userId', '=', 'users.id')->leftJoin('product', 'production.model_no', '=', 'production.id')
        ->select('production.barcode as id', 'product.section as section', 'product.line as line', 'product.model_no as model_no',
        'production.lotno as lotno', 'production.shift as shift', 'production.fg_1 as finish_goods',
        'quality.judgement as judgement', 'users.name as checker')->get();
        return view('finish_data', ['data' => $record, 'line' => $line, 'section' => $section, 'i' => 1]);
    }
    public function transaction_data() 
    {
        $line = DB::table('product')->select('line')->distinct()->get();
        $section = DB::table('product')->select('section')->distinct()->get();
        $record = DB::table('production')->where('status', 3 )->get();
        return view('transaction_data', ['data' => $record, 'line' => $line, 'section' => $section, 'i' => 1]);
    }
    public function transfers_records() 
    {
        $line = DB::table('product')->select('line')->distinct()->get();
        $section = DB::table('product')->select('section')->distinct()->get();
        $record = DB::table('production')->where('status', '>', 3 )->orderBy('lotno', 'desc')->get();
        return view('transfers_records', ['data' => $record, 'line' => $line, 'section' => $section, 'i' => 1]);
    }
}
