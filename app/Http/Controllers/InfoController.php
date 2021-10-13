<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Http;

use App\User;
use App\DynamicField;
Use Redirect;
use Auth;
use PDF;

use Illuminate\Support\Facades\Hash;

class InfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function tabel($id) {
        $now = date('m');
        $lini = DB::table('produk')->where('bagian', $id)->select('tempat')->orderBy('tempat', 'desc')->distinct()->get();
        $data = DB::table('dataharian')->rightJoin('hasil_prod', 'dataharian.keyid', '=', 'hasil_prod.keyid')->where('dataharian.bagian', $id)->get();
        return view('tabelline', ['data' => $data, 'tipe' => $id, 'line' => $lini]);
    }

    public function graph($id) {
        $lini   = DB::table('produk')->where('bagian', $id)->select('tempat')->orderBy('tempat', 'asc')->distinct()->get();
        $actual = array();
        $nowm   = date('m');
        $nowy   = date('Y');
        foreach ($lini as $li) {
            $actual[]  = DB::table('rekap_prod')
            ->leftJoin('dataharian', 'dataharian.keyid', '=', 'rekap_prod.keyid')
            ->where('dataharian.bagian', $id)->where('dataharian.line', $li->tempat)->whereYear('dataharian.tanggal', $nowy)->whereMonth('dataharian.tanggal', '=', $nowm)->orderBy('produk.line', 'asc')->sum('rekap_prod.daily_actual');
        }
        return view('graphline', ['tipe' => $id, 'lini' => $lini, 'actual' => $actual]);
    }

    public function graphbulan(Request $reqest, $id) {
        $ttl = array();
        $plan = array();
        $act = array();
        if (isset($request->tanggal)) {
        }else {
            $bulan = date('m');
            $tahun = date('Y');
            $ttl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            for ($i = 1; $i<=$ttl; $i++) {
                $act[]  = DB::table('lotcard')->join('produk', 'lotcard.modelno', '=', 'produk.tipe')->where('produk.tempat', $id)
                ->whereMonth('lotcard.lotno', '=', $bulan)->whereDay('lotcard.lotno', $i)->whereYear('lotcard.lotno', $tahun)
                ->sum('lotcard.input1');
                $plan[]  = DB::table('planning')->where('tempat', $id)
                ->whereMonth('bulan', '=', $bulan)->whereDay('bulan', $i)->whereYear('bulan', $tahun)
                ->sum('qty');
            }
        }
        return view('graphbulan', ['index' => $ttl, 'planning' => $plan, 'actual' => $act, 'judul' => $id]);
    }

    public function delparts($id){
        DB::table('parts')->where('id', $id)->delete();
    }

    public function jsonwelcome() {
        $result = DB::table('dataharian')->where('stockName','=','Infosys')->orderBy('stockYear', 'ASC')->get();
        return response()->json($result);
    }

    public function welcome() {
       return redirect('/home');
    }

    public function lotcard0() {
        $line   = DB::table('produk')->select('bagian')->distinct()->get();
        return view('user.lotcard0', ['line' => $line,]);
    }

    public function lotcardalpha(Request $request) {
        $parts = DB::table('parts')->where('modelno', $request->tipe)->get();
        $location = $request->tempat;
        $shift = DB::table('waktu')->select('shift')->get();
        return view('user.lotcardalpha', ['data' => $parts, 'shift' => $shift, 'option' => $request->tipe, 'i' => 1, 'tempat' => $location]);
    }

    public function lotcardalpha2($param0){
        $parts = DB::table('parts')->where('modelno', $data0[0]['assembly_item_name'])->get();
        $shift = DB::table('waktu')->select('shift')->get();
        return view('user.lotcardalpha', ['data' => $parts, 'shift' => $shift, 'jobid' => $data0[0]['job_number'],
        'option' => $data0[0]['assembly_item_name'], 'i' => 1]);
    }

    public function lotscaned(){
            $tanggal = date('d M Y');
            $data = DB::table('lotcard')
            ->leftJoin('produk', 'lotcard.modelno', '=', 'produk.tipe')
            ->select('lotcard.modelno as type', 'lotcard.lotno as nolot' , 'lotcard.input2 as totalbox', 'lotcard.input1 as totalqty', 'lotcard.ng1 as ng')
            ->where('lotcard.status', 1)->distinct()->get();
        return view('user.lotscaned', ['data' => $data]);
    }

    public function dellot($id) {
        DB::table('lotcard')->where('barcode', $id)->delete();
        return redirect('/lotstatus');
    }

    public function plusalpha(Request $request) {
        $date  = base_convert(date("ymdHms"),10,32);
        $lotid = strtoupper($date);
        $parts = $request->part;
        $lotparts = $request->lotpart;
        if (isset($request->part)) {
            for ($htng = 0; $htng < count($parts); $htng++) {
                $data = array(
                'id' => $lotid.str_pad($htng, 2, '0', STR_PAD_LEFT),
                'barcode' => $lotid,
                'modelno' => $request->tipe,
                'tempat' => $request->tempat,
                'lotno' => $request->tanggal,
                'shift'=> $request->shift,
                'partname' => $parts[$htng],
                'nolot' => $lotparts[$htng],
                'input1' => $request->input1,
                'input2' => $request->input2,
                'ng1' => $request->ng1,
                'ng2' => $request->ng2,
                'date1' => $request->date1,
                'date2' => $request->date2,
                'name1' => $request->name1,
                'name2' => $request->name2,
                );
                $insert_data[] = $data; 
                if (DB::table('parts')->where('modelno', $request->tipe)->where('partname', $parts[$htng])->doesntExist()) {
                    DB::table('parts')->insert([
                        'partname' => strtoupper($parts[$htng]),
                        'modelno' => strtoupper($request->tipe),
                    ]);
                 }
            }
            DB::table('lotcard')->insert($insert_data);
            return redirect('/cetaklot/'.$lotid);
        } else {
            return redirect('/lotcard0')->withErrors(['msg', 'The Message']);
        }
    }

    public function lotcard(Request $request) {
        $tipe  = DB::table('produk')->where('tempat', $request->tempat)->select('tipe')->get();
        $shift = DB::table('waktu')->select('shift')->get();
        $parts = DB::table('parts')->select('part')->where('model', $request->model)->get();
        return view('user.lotcard', ['data' => $parts, 'tipe' => $tipe, 'shift' => $shift]);
    }

    public function lotstatus(Request $request) {
        $year = date('Y');
        $month = date('m') - 1;
        if (isset($request->tanggal)) {
            $data = DB::table('lotcard')->Leftjoin('produk', 'produk.tipe', '=', 'lotcard.modelno')->select('lotcard.tempat','lotcard.barcode','lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.input1', 'lotcard.ng1', 'lotcard.name2', 'lotcard.status')->whereYear('lotcard.lotno', $year)->whereMonth('lotcard.lotno', '>', $month)->where('lotcard.lotno', $request->tanggal)->distinct('barcode')->get();
            return view('user.lotstatus', ['data' => $data]);
        }else {
            $data = DB::table('lotcard')->Leftjoin('produk', 'produk.tipe', '=', 'lotcard.modelno')->whereYear('lotcard.lotno', $year)->whereMonth('lotcard.lotno', '>', $month)->select('lotcard.tempat','lotcard.barcode','lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.input1', 'lotcard.ng1', 'lotcard.name2', 'lotcard.status')->distinct('barcode')->get();
            return view('user.lotstatus', ['data' => $data]);
        }
    }
    public function lotdetail($id) {
        $data0 = DB::table('lotcard')->where('barcode', $id)->get();
        $data1 = DB::table('lotcard')->where('barcode', $id)->select('barcode', 'modelno', 'lotno', 'shift', 'input1', 'ng1', 'date1', 'name1', 'input2', 'ng2', 'date2', 'name2', 'status')->distinct('barcode')->get();
        // $pdf = PDF::loadview('user.lotdetail', ['data' => $data1, 'data1' => $data0]);
	    // return $pdf->stream();
        return view ('user.lotframe', ['id' => $id, 'data' => $data1, 'data1' => $data0]);
    }

    public function cetaklot($id) {
        $customPaper = array(0,0,245,500);
        $data0 = DB::table('lotcard')->where('barcode', $id)->get();
        $data1 = DB::table('lotcard')->where('barcode', $id)->select('barcode', 'modelno', 'lotno', 'shift', 'input1', 'ng1', 'date1', 'name1', 'input2', 'ng2', 'date2', 'name2')->distinct('barcode')->get();
        $pdf   = PDF::loadview('dll.lotdetail', ['data' => $data1, 'data1' => $data0]);
        $pdf->setPaper($customPaper);
	    return $pdf->stream();
    }
}
