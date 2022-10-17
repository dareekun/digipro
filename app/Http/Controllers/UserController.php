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
        'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.judgement as judgement', 'product.packing as packing', 'quality.date as date', 'quality.remark as remark')
        ->get();
        // return $record;
	    return PDF::loadview('dll.detail_inspection', ['data' => $record])->setPaper($customPaper)->stream();
    }

    public static function menu(){
        $menu = DB::table('produk')->select('bagian')->distinct()->orderBy('bagian')->pluck('bagian');
        return $menu;
    }
    public function input0($id){
        $s1     = Auth::user();
        $line   = DB::table('produk')->where('bagian', $id)->select('tempat')->distinct()->orderBy('tempat')->get();
        $waktu  = DB::table('waktu')->select('shift', 'value')->get();
        $stat   = DB::table('dataharian')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        $data   = DB::table('dataharian')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('keyid')->distinct()->value('keyid');
        return view('user.data', ['bagian' => $id, 'line' => $line, 'waktu' => $waktu, 'status' => $stat, 'data' => $data]);
    }
    public function next(Request $request) {
        $s0 = DB::table('waktu')->select('start')->where('shift', $request->shift)->value('start');
        $s1 = DB::table('waktu')->select('finish')->where('shift', $request->shift)->value('finish');
        $s2 = DB::table('waktu')->select('duration')->where('shift', $request->shift)->value('duration');
        $s4 = DB::table('waktu')->select('value')->where('shift', $request->shift)->value('value');
        $s3 = Auth::user();
        $keyid = strtoupper(base_convert($s3->id.date('YmdHis'),10,32));
        $id = DB::table('produk')->select('bagian')->distinct()->where('tempat', $request->line)->value('bagian');
        DB::table('dataharian') ->insert([
            'keyid' => $keyid,
            'bagian' => $id,
            'tanggal' => $request->tanggal,
            'line'=> $request->line,
            'pic' => $request->pic,
            'shift' => $request->shift,
            'kartap' => $request->kartap,
            'absenkartap' => $request->absenkartap,
            'waktukartap' => $s2,
            'otkartap' => $request->otkartap,
            'kwt' => $request->kwt,
            'absenkwt' => $request->absenkwt,
            'waktukwt' => $s2,
            'otkwt' => $request->otkwt,
            'izin' => $request->izin,
            'optplan' => $request->kartap + $request->kwt,
            'start' => $s0,
            'finish' => $s1,
            'waktukerja' => ($s2 * $request->kartap) + ($s2 * $request->kwt) + $request->otkartap + $request->otkwt + $request->waktumasuk - $request->waktukeluar,
            'bantuan_masuk' => $request->bantuanmasuk,
            'bantuan_keluar' => $request->bantuankeluar,
            'bantuan_masuk_waktu' => $request->waktumasuk,
            'bantuan_keluar_waktu' => $request->waktukeluar,
            'lastedit' => $s3->username,
            'autosave' => 'belum',
        ]);
        return redirect('/resume/'.$keyid);
    }
    public function refresh($id) {
        $s1 = DB::table('dataharian')->select('bagian')->where('keyid', $id)->value('bagian');
        DB::table('dataharian')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('rekap_prod')->where('keyid', $id)->delete();
        return redirect('/data/'.$s1);
    }
    public function resume($id) {
        $s1 = Auth::user();
        $s2 = DB::table('dataharian')->select('bagian')->where('keyid', $id)->distinct()->value('bagian');
        $s3 = DB::table('dataharian')->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        if ($s3 == 'selesai') {
            return redirect('/data/'.$bagian);
        }
        $data  = DB::table('dataharian')->where('keyid', $id)->get();
        $bline = DB::table('produk')->where('bagian', $s2)->select('tempat')->distinct()->orderBy('tempat')->get();
        $waktu = DB::table('waktu')->select('shift')->get();
        $p1 = DB::table('rekap_prod')->select('id')->where('keyid', $id)->where('status', 0)->where('lastedit', $s1->username)->value('id');
        return view('user.data2', ['bagian' => $s2, 'data' => $data, 'bline' => $bline, 'waktu' => $waktu, 'refer' => $id, 'tagkey' => $p1]);
    }
    // ===================================================
    // ================= H A R I A N 2 ===================
    // ===================================================
    public function next2(Request $request) {
        $s1 = Auth::user();
        $s2 = DB::table('waktu')->where('shift', $request->shift)->select('duration')->value('duration');
        DB::table('dataharian')->where('keyid', $request->subaru)->update([
            'tanggal' => $request->tanggal,
            'line'=> $request->line,
            'pic' => $request->pic,
            'shift' => $request->shift,
            'kartap' => $request->kartap,
            'absenkartap' => $request->absenkartap,
            'waktukartap' => $s2,
            'otkartap' => $request->otkartap,
            'kwt' => $request->kwt,
            'absenkwt' => $request->absenkwt,
            'waktukwt' => $s2,
            'otkwt' => $request->otkwt,
            'izin' => $request->izin,
            'optplan' => $request->optplan,
            'start' => $request->start,
            'finish' => $request->finish,
            'waktukerja' => ($s2 * $request->kartap) + ($s2 * $request->kwt) + $request->otkartap + $request->otkwt + $request->waktumasuk - $request->waktukeluar,
            'bantuan_masuk' => $request->bantuanmasuk,
            'bantuan_keluar' => $request->bantuankeluar,
            'bantuan_masuk_waktu' => $request->waktumasuk,
            'bantuan_keluar_waktu' => $request->waktukeluar,
            'lastedit' => $s1->username,
        ]);
        return redirect('/resume/'.$request->subaru);
    }
    public function hapusdataproduk($id){
        $alamat = DB::table('dataharian')->where('keyid', $id)->select('bagian')->value('bagian');
        DB::table('dataharian')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('resultprod')->where('keyid', $id)->delete();
        DB::table('rekap_prod')->where('keyid', $id)->delete();
        return redirect('/tabel/'.$alamat);
    }
    
    public function detail($id) {
        $a = DB::table('dataharian')->where('keyid', $id)->get();
        $b = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Regulated Loss')->where('keyid', $id)->get();
        $c = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Work Loss')->where('keyid', $id)->get();
        $d = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Organization Loss')->where('keyid', $id)->get();
        $e = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Defect Loss')->where('keyid', $id)->get();
        $f = DB::table('rekap_prod')->where('keyid', $id)->get();
        $g = DB::table('hasil_prod')->where('keyid', $id)->get();
        return view('admin.detail', ['data1' => $a, 'data2' => $b, 'data3' => $c, 'data4' => $d, 'data5' => $e, 'data6' => $f, 'data7' => $g, 'id' => $id]);
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
            DB::table('quality')->insert([
                'productionId' => $productionId,
                'judgement'    => $request->status,
                'remark'       => $request->remark != NULL ? : "-",
                'userId'       => Auth::user()->id,
            ]);
            DB::table('production')->where('barcode', $request->barcode_id)->update([
                'fg_1'   => $request->lot_size,
                'fg_2'   => $request->total_box,
                'status' => 1
            ]);
            DB::table('product')->where('id', $model_no)->update([
                'packing' => $request->packing_size
            ]);
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
            ->select('production.barcode as barcode', 'product.model_no as model_no', 'product.packing as packing', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.remark as remark',
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
            'quality.judgement as judgement', 'users.name as checker_name', 'product.section as section', 'product.line as line')->get();
            return redirect(route('show_inspection', $request->barcode_id));
        } else {
            return "Error 403, Forbidden User Input";
        }
    }

    public function generate_data() {
        if (Auth::user()->department == 5 || Auth::user()->department == 1) {
            if (DB::table('transaction')->where('referTransfers', 0)->doesntExist()) {
                return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'No Production Data Has Been Scanned']);
            } else {
                
            }
        } else {
            return "Error 403, Forbidden User Input";
        }
    }
}