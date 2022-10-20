<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;

use App\User;
Use Redirect;
use Auth;
use PDF;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function new_lotcard(Request $request) {
        $model = DB::table('product')->where('id', $request->tipe)->select('model_no', 'id')->get();
        $parts = DB::table('materials')->where('model_no', $request->tipe)->get();
        return view('dll.new_lotcard', ['parts' => $parts, 'option' => $model, 'i' => 1]);
    }

    public function add_lotcard(Request $request) {
        $lotid = strtoupper(base_convert(date("ymdHms"),10,32));
        $parts = $request->parts;
        $lotparts = $request->lot_parts;
        if (isset($request->parts)) {
            for ($i = 0; $i < count($parts); $i++) {
                $data = array(
                'parts' => $parts[$i],
                'lot_parts' => $lotparts[$i],
                );
                $insert_data[] = $data; 
                    DB::table('materials')->updateOrInsert([
                        'part_name' => strtoupper($parts[$i]),
                        'model_no' => strtoupper($request->tipe)
                    ]);
            }
            DB::table('production')->insert([
                'barcode' => $lotid,
                'model_no' => $request->tipe,
                'lotno' => date('Ymd', strtotime($request->tanggal)),
                'date' => $request->tanggal,
                'shift'=> $request->shift,
                'parts_data' => json_encode($insert_data),
                'fg_1' => $request->input1,
                'fg_2' => $request->input2,
                'ng_1' => $request->ng1,
                'ng_2' => $request->ng2,
                'date_1' => $request->date1,
                'date_2' => $request->date2,
                'Name_1' => $request->name1,
                'name_2' => $request->name2,
            ]);
            return redirect(route('show_lotcard', $lotid));
        } else {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Error Input Data, please check your data']);
        }
    }

    public function show_lotcard($id) {
        $customPaper = array(0,0,245,500);
        $record = DB::table('production')->where('barcode', $id)->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
        'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.ng_1 as ng_1', 'production.ng_2 as ng_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status',
        'production.name_1 as name_1', 'production.name_2 as name_2')
        ->get();
        // return $record;
	    return PDF::loadview('dll.detail_lotcard', ['data' => $record])->setPaper($customPaper)->stream();
    }

    public function show_inspection($id){
        $customPaper = array(0,0,245,500);
        $record = DB::table('production')->where('barcode', $id)->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
        ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
        'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status', 'product.section as section', 'product.line as line',
        'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.judgement as judgement', 'product.packing as packing', 'quality.date as date', 'quality.remark as remark', 'quality.userId as checker')
        ->get();
        // return $record;
	    return PDF::loadview('dll.detail_inspection', ['data' => $record])->setPaper($customPaper)->stream();
    }

    public static function menu(){
        $menu = DB::table('produk')->select('bagian')->distinct()->orderBy('bagian')->pluck('bagian');
        return $menu;
    }

    public function create_inspection(Request $request) {
        if (Auth::user()->department == 4 || Auth::user()->department == 1) {
            if ($request->packing_size == 0) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Packing Size (@ BOX) Must Be Bigger Than 0']);
            }
            if ($request->total_box == 0) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Total Box Must Be Bigger Than 0']);
            }
            if ($request->lot_size == 0) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Lot Size Must Be Bigger Than 0']);
            }
            $productionId = DB::table('production')->where('barcode', $request->barcode_id)->value('id');
            $model_no     = DB::table('production')->where('barcode', $request->barcode_id)->value('model_no');
            if (DB::table('quality')->where('productionId', $productionId)->doesntExist()) {
                DB::table('quality')->insert([
                    'productionId' => $productionId,
                    'judgement'    => $request->status,
                    'remark'       => $request->remark != NULL ? $request->remark : "-",
                    'userId'       => $request->checker
                ]);
                DB::table('production')->where('barcode', $request->barcode_id)->update([
                    'fg_1'   => $request->lot_size,
                    'fg_2'   => $request->total_box,
                    'status' => 1
                ]);
                DB::table('product')->where('id', $model_no)->update([
                    'packing' => $request->packing_size
                ]);
                    $customPaper = array(0,0,245,500);
                    $random = rand(10, 99);
                    $record = DB::table('production')->where('barcode', $request->barcode_id)->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
                    ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
                    'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status', 'product.section as section', 'product.line as line',
                    'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.judgement as judgement', 'product.packing as packing', 'quality.date as date', 'quality.remark as remark', 'quality.userId as checker')
                    ->get();
                    $content = PDF::loadview('dll.detail_inspection', ['data' => $record])->setPaper($customPaper)->download()->getOriginalContent();
                    Storage::put('inspection_'.$random.$request->barcode_id.'.pdf', $content);
                    exec('lp /var/www/digipro/storage/app/inspection_'.$random.$request->barcode_id.'.pdf -o fit-to-page');
                    exec('rm /var/www/digipro/storage/app/inspection_'.$random.$request->barcode_id.'.pdf');
    
                return redirect(route('show_inspection', $request->barcode_id));
            } else {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Error 500, Modify Force Input']);
            }
        } else {
            return redirect(route('dashboard'))->with('alerts', ['type' => 'alert-danger', 'message' => 'Error 403, Forbidden User Input']);
        }
    }

    public function print_inspection($id) {
        if (Auth::user()->department == 4 || Auth::user()->department == 1) {
            $productionId = DB::table('production')->where('barcode', $id)->value('id');
            if (DB::table('quality')->where('productionId', $productionId)->doesntExist()) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Error 404, Data Not Found']);
            } else {
                $customPaper = array(0,0,245,500);
                $random = rand(10, 99);
                $record = DB::table('production')->where('barcode', $id)->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
                ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
                'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status', 'product.section as section', 'product.line as line',
                'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.judgement as judgement', 'product.packing as packing', 'quality.date as date', 'quality.remark as remark', 'quality.userId as checker')
                ->get();
                $content = PDF::loadview('dll.detail_inspection', ['data' => $record])->setPaper($customPaper)->download()->getOriginalContent();
                Storage::put('inspection_'.$random.$id.'.pdf', $content);
                exec('lp /var/www/digipro/storage/app/inspection_'.$random.$id.'.pdf -o fit-to-page');
                exec('rm /var/www/digipro/storage/app/inspection_'.$random.$id.'.pdf');
                return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Print command successfully sent']);
            }
        }
    }

    public function modify_inspection(Request $request) {
        if (Auth::user()->department == 4 || Auth::user()->department == 1) {
            if ($request->packing_size == 0) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Packing Size (@ BOX) Must Be Bigger Than 0']);
            }
            if ($request->total_box == 0) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Total Box Must Be Bigger Than 0']);
            }
            if ($request->lot_size == 0) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Lot Size Must Be Bigger Than 0']);
            }
            $productionId = DB::table('production')->where('barcode', $request->barcode_id)->value('id');
            $model_no     = DB::table('production')->where('barcode', $request->barcode_id)->value('model_no');
            DB::table('quality')->where('productionId', $productionId)->update([
                'judgement'    => $request->status,
                'remark'       => $request->remark != NULL ? $request->remark : "-",
                'userId'       => $request->checker
            ]);
            DB::table('production')->where('barcode', $request->barcode_id)->update([
                'fg_1'   => $request->lot_size,
                'fg_2'   => $request->total_box,
                'status' => 1
            ]);
            DB::table('product')->where('id', $model_no)->update([
                'packing' => $request->packing_size
            ]);
                $customPaper = array(0,0,245,500);
                $random = rand(10, 99);
                $record = DB::table('production')->where('barcode', $request->barcode_id)->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
                ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
                'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status', 'product.section as section', 'product.line as line',
                'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.judgement as judgement', 'product.packing as packing', 'quality.date as date', 'quality.remark as remark', 'quality.userId as checker')
                ->get();
                $content = PDF::loadview('dll.detail_inspection', ['data' => $record])->setPaper($customPaper)->download()->getOriginalContent();
                Storage::put('inspection_'.$random.$request->barcode_id.'.pdf', $content);
                exec('lp /var/www/digipro/storage/app/inspection_'.$random.$request->barcode_id.'.pdf -o fit-to-page');
                exec('rm /var/www/digipro/storage/app/inspection_'.$random.$request->barcode_id.'.pdf');

            return redirect(route('show_inspection', $request->barcode_id));
        } else {
            return redirect(route('dashboard'))->with('alerts', ['type' => 'alert-danger', 'message' => 'Error 403, Forbidden User Input']);
        }
    }

    public function generate_data() {
        if (Auth::user()->department == 5 || Auth::user()->department == 1) {
            if (DB::table('transaction')->where('referTransfers', 0)->doesntExist()) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'No Production Data Has Been Scanned']);
            } else {
                $current   = date('ymd').rand(10, 99);
                $item_type = DB::table('transaction')->leftJoin('production', 'transaction.productionId', '=', 'production.id')->where('referTransfers', 0)->count();
                $item_qty  = DB::table('transaction')->leftJoin('production', 'transaction.productionId', '=', 'production.id')->where('referTransfers', 0)->sum('production.fg_1');
                DB::table('transaction')->leftJoin('production', 'transaction.productionId', '=', 'production.id')->where('referTransfers', 0)->update([
                    'transaction.referTransfers' => $current,
                    'production.status' => 3
                ]);
                DB::table('transfers')->insert([
                    'refer' => $current,
                    'item_type' => $item_type,
                    'item_qty' => $item_qty,
                    'status' => 0,
                    'userId' => Auth::user()->id
                ]);
            }
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Successfully Generated']);
        } else {
            return redirect(route('dashboard'))->with('alerts', ['type' => 'alert-danger', 'message' => 'Error 403, Forbidden User Input']);
        }
    }

    public function show_pdf_form($id) {
        if (Auth::user()->department == 5 || Auth::user()->department == 1) {
            if (DB::table('transfers')->where('refer', $id)->doesntExist()) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Data Was Not Found']);
            } else {
                $transl = DB::table('transfers')->where('refer', $id)->value('transfers_date');
                $record = DB::table('transaction')->leftJoin('production', 'production.id', '=', 'transaction.productionId')
                ->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
                ->select('product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'product.packing as packing', 'production.fg_2 as total_box', 'production.fg_1 as total_qty', 'quality.remark as remark')
                ->where('transaction.referTransfers', $id)->get();
            }
            return PDF::loadview('dll.request_and_transfers', ['data' => $record, 'tanggal' => $transl, 'i' => 1])->setPaper('a4')->stream();
            // return view('dll.request_and_transfers', ['data' => $record, 'tanggal' => $transl, 'i' => 1]);
        } else {
            return redirect(route('dashboard'))->with('alerts', ['type' => 'alert-danger', 'message' => 'Error 403, Forbidden User Input']);
        }
    }
}