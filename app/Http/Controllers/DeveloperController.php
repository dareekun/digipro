<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

Use Redirect;
use Auth;

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
}
