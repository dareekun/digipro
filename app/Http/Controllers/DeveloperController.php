<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Storage;

Use Redirect;
use Auth;
use PDF;

class DeveloperController extends Controller
{
    public function bypass_data($id) {
            if (DB::table('production')->where('barcode', $id)->value('status') == 1) {
                DB::table('production')->where('barcode', $id)->update([
                    'status' => 2
                ]);
                $productionId = DB::table('production')->where('barcode', $id)->value('id');
                DB::table('transaction')->insert([
                    'productionId'   => $productionId,
                    'userId'         => Auth::user()->id,
                    'referTransfers' => 0
                ]);
                return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Successfully Bypassed']);
            } else {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Error Input Data, please check your data']);
            }
        } 

    public function bypass_scan() {
        $record = DB::table('production')->where('status', 1)->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->leftJoin('product', 'product.id', '=', 'production.model_no')->leftJoin('users', 'quality.userId', '=', 'users.id')
        ->select('production.barcode as id', 'product.section as section', 'product.line as line', 'product.model_no as model_no',
        'production.lotno as lotno', 'production.shift as shift', 'production.fg_1 as finish_goods',
        'quality.judgement as judgement', 'users.name as checker')->get();
        return view('bypass_device', ['data' => $record]);
    }

    public function printer_control() {
        $record = DB::table('printer')->get();
        return view('control.printer_control', ['printer' => $record]);
    }

    public function data_control() {
        $record = DB::table('production')->leftJoin('product', 'product.id', '=', 'production.model_no')->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->select('production.id as id', 'production.barcode as barcode', 'production.lotno as lotno', 'production.shift as shift', 'product.model_no as model_no', 
        'production.fg_1 as finish_goods', 'production.name_1 as pic', 'production.status as status', 'quality.judgement as judgement')->get();
        return view('control.data_control', ['data' => $record]);
    }

    public function closed_data($id) {
        if (DB::table('quality')->where('productionId', $id)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'User NIK Already Exists']);
        } else {
            DB::table('production')->where('id', $id)->update([
                'status' => 99
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Successfully Closed']);
        }
    }

    public function delete_data($id) {
        if (DB::table('quality')->where('productionId', $id)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Data Already Created On Inspection']);
        } else {
            DB::table('production')->where('id', $id)->delete();
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Successfully Delete']);
        }
    }

    public function print_lotcard($id) {
        $customPaper = array(0,0,245,500);
        $random = rand(10, 99);
        $record = DB::table('production')->where('barcode', $id)->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
        'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.ng_1 as ng_1', 'production.ng_2 as ng_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status',
        'production.name_1 as name_1', 'production.name_2 as name_2')
        ->get();
        $content = PDF::loadview('dll.detail_lotcard', ['data' => $record])->setPaper($customPaper)->download()->getOriginalContent();
        Storage::put('lotcard_'.$random.$id.'.pdf', $content);
        exec('lp /var/www/digipro/storage/app/lotcard_'.$random.$id.'.pdf -o fit-to-page -d'.Auth::user()->printer);
        exec('rm /var/www/digipro/storage/app/lot_card'.$random.$id.'.pdf');
        return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Command Successfully Send']);
    }
}
