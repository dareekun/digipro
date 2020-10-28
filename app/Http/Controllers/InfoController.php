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
        if ($id == 'Compression' || $id == 'Injection') {
            $data = DB::table('datamasin')->rightJoin('resultmesin', 'datamasin.keyid', '=', 'resultmesin.keyid')->where('datamasin.bagian', $id)->get();
        }
        else {
            $data = DB::table('dataharian')->rightJoin('resultprod', 'dataharian.keyid', '=', 'resultprod.keyid')->where('dataharian.bagian', $id)->get();
        }
        return view('tabelline', ['data' => $data, 'tipe' => $id]);
    }

    public function graph($id) {
        $lini = DB::table('produk')->where('bagian', $id)->select('tempat')->orderBy('tempat', 'desc')->distinct()->get();
        $plan = array();
        $actual = array();
        $nown = date('m');
        if ($id == 'Compression' || $id == 'Injection') {
            foreach ($lini as $li) {
                $actual[]  = DB::table('rekapprod')->join('dataharian', 'dataharian.keyid', '=', 'rekapprod.keyid')->where('dataharian.bagian', $id)->where('dataharian.line', $li->tempat)->whereMonth('tanggal', '=', $nown)->orderBy('dataharian.line', 'desc')->sum('rekapprod.fg');
                $plan[]  = DB::table('planning')->where('bagian', $id)->where('tempat', $li->tempat)->whereMonth('bulan', '=', $nown)->orderBy('tempat', 'desc')->sum('qty');
            }
        }
        else {
            foreach ($lini as $li) {
                $actual[]  = DB::table('rekapprod')->join('dataharian', 'dataharian.keyid', '=', 'rekapprod.keyid')->where('dataharian.bagian', $id)->where('dataharian.line', $li->tempat)->whereMonth('tanggal', '=', $nown)->orderBy('dataharian.line', 'desc')->sum('rekapprod.fg');
                $plan[]  = DB::table('planning')->where('bagian', $id)->where('tempat', $li->tempat)->whereMonth('bulan', '=', $nown)->orderBy('tempat', 'desc')->sum('qty');
            }
        }
        return view('graphline', ['tipe' => $id, 'lini' => $lini, 'planning' => $plan, 'actual' => $actual]);
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
                $act[]  = DB::table('rekapprod')->join('dataharian', 'dataharian.keyid', '=', 'rekapprod.keyid')->where('dataharian.line', $id)
                ->whereMonth('tanggal', '=', $bulan)->whereDay('tanggal', $i)->whereYear('tanggal', $tahun)
                ->sum('rekapprod.fg');
                $plan[]  = DB::table('planning')->where('tempat', $id)
                ->whereMonth('bulan', '=', $bulan)->whereDay('bulan', $i)->whereYear('bulan', $tahun)
                ->sum('qty');
            }

        }
        return view('graphbulan', ['index' => $ttl, 'planning' => $plan, 'actual' => $act]);
    }

    public function jsonwelcome() {
        $result = DB::table('dataharian')->where('stockName','=','Infosys')->orderBy('stockYear', 'ASC')->get();
        return response()->json($result);
    }

    public function plan() {
        return view('plansetup');
    }

    public function plan2() {
        return view('plansetup2');
    }

    public function welcome2() {
        return view('welcome');
    }

    public function welcome() {
        $tahun = date('Y');
        $bulan = date('m');
        $a  = DB::table('dataharian')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->rightJoin('resultprod', 'dataharian.keyid', '=', 'resultprod.keyid')->select('resultprod.hasil')->where('dataharian.bagian', 'Assy WD')->sum('resultprod.hasil');
        $b  = DB::table('datamasin')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->rightJoin('resultmesin', 'datamasin.keyid', '=', 'resultmesin.keyid')->select('resultmesin.hasil')->where('datamasin.bagian', 'Compression')->sum('resultmesin.hasil');
        $c  = DB::table('datamasin')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->rightJoin('resultmesin', 'datamasin.keyid', '=', 'resultmesin.keyid')->select('resultmesin.hasil')->where('datamasin.bagian', 'Injection')->sum('resultmesin.hasil');
        $d  = DB::table('dataharian')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->rightJoin('resultprod', 'dataharian.keyid', '=', 'resultprod.keyid')->select('resultprod.hasil')->where('dataharian.bagian', 'Metal Part')->sum('resultprod.hasil');
        $e  = DB::table('dataharian')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)->rightJoin('resultprod', 'dataharian.keyid', '=', 'resultprod.keyid')->select('resultprod.hasil')->where('dataharian.bagian', 'Export')->sum('resultprod.hasil');
        $aa = DB::table('planning')->select('qty')->where('bagian', 'Assy WD')->sum('qty');
        $ab = DB::table('planning')->select('qty')->where('bagian', 'Assy Part Compression')->sum('qty');
        $ac = DB::table('planning')->select('qty')->where('bagian', 'Assy Part Injection')->sum('qty');
        $ad = DB::table('planning')->select('qty')->where('bagian', 'Metal Part')->sum('qty');
        $ae = DB::table('planning')->select('qty')->where('bagian', 'Export')->sum('qty');
        $totalp = $aa + $ab + $ac + $ad + $ae;
        $totala = $a + $b + $c + $d + $e;
        return view('welcome', ['AssyP' => $aa, 'CompressionP' => $ab, 'InjectionP' => $ac, 'MetalP' => $ad, 'ExportP' => $ae, 
        'AssyA' => $a, 'CompressionA' => $b, 'InjectionA' => $c, 'MetalA' => $d, 'ExportA' => $e,
        'TotalA' => $totala, 'TotalP' => $totalp ]);
    }

    public function lotcard0() {
        $line   = DB::table('produk')->select('bagian')->distinct()->get();

        $htts   = Http::get('http://158.118.35.22:8080/discreet')->status();
        if ($htts == 200) {
            $htta   = Http::get('http://158.118.35.22:8080/discreet')->getBody();
            $data0  = json_decode($htta, true);
            $data1  = json_decode(DB::table('produk')->get(), true);
            $total0 = count($data0);
            $total1 = count($data1);
            for ($i = 0; $i < $total0; $i++) {
                for ($a = 0; $a < $total1; $a++) {
                    if ($data0[$i]['assembly_item_name'] == $data1[$a]['tipe']){
                            $data0[$i]['bagian'] = $data1[$a]['bagian'];
                            $data0[$i]['line'] = $data1[$a]['tempat'];
                    break;
                    }
                    else {
                        $data0[$i]['bagian'] = "";
                        $data0[$i]['line'] = "";
                    }
                }
            }
        } else {
            $data0 = Http::get('http://158.118.35.22:8080/discreet')->getBody();
        }
        
        return view('user.lotcard0', ['line' => $line, 'data' => $data0, 'status' => $htts]);
    }

    public function lotcardalpha(Request $request) {
        $parts = DB::table('parts')->where('modelno', $request->tipe)->get();
        $shift = DB::table('waktu')->select('shift')->get();
        return view('user.lotcardalpha', ['data' => $parts, 'shift' => $shift, 'option' => $request->tipe, 'i' => 1, 'jobid' => '']);
    }

    public function lotcardalpha2($param0){
        $htta  = Http::get('http://158.118.35.22:8080/discreetdetail/'.$param0)->getBody();
        $data0 = json_decode($htta, true);

        $parts = DB::table('parts')->where('modelno', $data0[0]['assembly_item_name'])->get();
        $shift = DB::table('waktu')->select('shift')->get();
        return view('user.lotcardalpha', ['data' => $parts, 'shift' => $shift, 'jobid' => $data0[0]['job_number'],
        'option' => $data0[0]['assembly_item_name'], 'i' => 1]);
    }

    public function lotscaned(Request $request){
        if (isset($request->scandate)) {
            $tanggal = date('d M Y', strtotime($request->scandate));
            $data = DB::table('finish_job')
            ->select('Job', 'Type', 'Assembly', 'Class', 'Quantity', 'Status', 'Start Date as Start_Date', 'Completion Date as Completion_Date', 'Quantity Remained as Quantity_Remained', 'FromA', 'ToA', 'Overcompletion Quantity as Overcompletion_Quantity', 'Transaction Date as Transaction_Date', 'Reference', 'Organization ID as Organization_ID')
            ->where('tanda', 1)->whereDate('Transaction Date', $request->scandate)->distinct()->get();
        }else {
            $tanggal = date('d M Y');
            $data = DB::table('finish_job')
            ->select('Job', 'Type', 'Assembly', 'Class', 'Quantity', 'Status', 'Start Date as Start_Date', 'Completion Date as Completion_Date', 'Quantity Remained as Quantity_Remained', 'FromA', 'ToA', 'Overcompletion Quantity as Overcompletion_Quantity', 'Transaction Date as Transaction_Date', 'Reference', 'Organization ID as Organization_ID')
            ->where('tanda', 1)->distinct()->get();
        }
        return view('user.lotscaned', ['data' => $data, 'date' => $tanggal]);
    }

    public function dellot($id) {
        DB::table('lotcard')->where('barcode', $id)->delete();
        DB::table('finish_job')->where('id', $id)->delete();
        return redirect('/lotstatus');
    }

    public function plusalpha(Request $request) {
        $line = explode(" ", DB::table('produk')->where('tipe', $request->tipe)->select('tempat')->value('tempat'));
        $shift = explode(" ", $request->shift);
        $date = date("Ymd", strtotime($request->tanggal));
        $acl = "";
        $acs = "";
        foreach ($shift as $q) {
            $acs .= $q[0];
        }
        $last  = DB::table('lotcard')->select('barcode')->where('lotno', $request->tanggal)->where('modelno', $request->tipe)->distinct()->count('barcode')+1;
        $lotid = $acs.'N'.$last.trim($request->tipe,'-').$date;
        $parts = $request->part;
        $lotparts = $request->lotpart;
        if (isset($request->part)) {
            for ($htng = 0; $htng < count($parts); $htng++) {
                $data = array(
                'id' => $lotid.$htng,
                'barcode' => $lotid,
                'keyid' => "Private",
                'modelno' => $request->tipe,
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
            if ($request->jobid != "") {
                $htta  = Http::get('http://158.118.35.22:8080/discreetdetail/'.$request->jobid)->getBody();
                $data0 = json_decode($htta, true);
                $sisa  = $data0[0]['plan_qty'] - $request->input1;
                if ($sisa == 0) {
                    $status = "Completed";
                }
                else {
                    $status = "Released";
                }
                $job = $request->jobid;
                $class = $data0[0]['class'];
                $quantity = $data0[0]['plan_qty'];
                $type = $data0[0]['type'];
                $start = $data0[0]['job_start_date'];
                $tanda = 0;
            }
            else {
                $job = "1W2L50-D-".strtoupper(date('dMY'))."-".$request->tipe;
                $type = "Standard";
                $class = "Std. A/C";
                $quantity = $request->input1;
                $start = date('Y-m-d 00:00:00');
                $sisa = 0;
                $status = "Completed";
                $tanda = 1;
            }
            DB::table('finish_job')->insert([
                'id' => $lotid,
                'Job' => $job,
                'Type' => $type,
                'Assembly' => $request->tipe,
                'Class' => $class,
                'Quantity' => $quantity,
                'Status' => $status,
                'Start Date' => $start,
                'Quantity Remained' => $sisa,
                'Overcompletion Quantity' => $request->input1,
                'tanda' => $tanda
            ]);
            return redirect('/cetaklot/'.$lotid);
        } else {
            return redirect('/lotcard0')->withErrors(['msg', 'The Message']);
        }
    }

    public function lotcard(Request $request) {
        $id = '';
        $tipe  = DB::table('produk')->where('tempat', $request->tempat)->select('tipe')->get();
        $shift = DB::table('waktu')->select('shift')->get();
        $parts = DB::table('parts')->select('part')->where('model', $request->model)->get();
        return view('user.lotcard', ['data' => $parts, 'tipe' => $tipe, 'shift' => $shift, 'keyid' => $id]);
    }
    public function lotcard1(Request $request) {
        $line = explode(" ", DB::table('produk')->where('tipe', $request->tipe)->select('tempat')->value('tempat'));
        $shift = explode(" ", $request->shift);
        $date = date("Ymd", strtotime($request->tanggal));
        $acl = "";
        $acs = "";
        foreach ($shift as $q) {
            $acs .= $q[0];
        }
        $last  = DB::table('lotcard')->select('barcode')->where('keyid', $request->keyid)->distinct('id')->count('id')+1;
        $nlm   = DB::table('rekapprod')->select('keyid')->where('keyid', $request->keyid)->distinct('id')->count('id');
        $lotid = $acs.'N'.$last.trim($request->tipe,'-').$date;
        $parts = $request->part;
        $lotparts = $request->lotpart;
        for ($htng = 0; $htng < count($parts); $htng++) {
            $data = array(
            'id' => $lotid.$htng,
            'barcode' => $lotid,
            'keyid' => 'N'.$nlm.$request->keyid,
            'modelno' => $request->tipe,
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
        }
        DB::table('lotcard')->insert($insert_data);
        DB::table('rekapprod')->where('keyid', $request->keyid)->update([
            'status' => 1,
        ]);
        return redirect('/resume/'.$request->keyid);
    }

    public function lotstatus(Request $request) {
        if (isset($request->tempat)) {
            $line = DB::table('produk')->select('bagian')->distinct()->get();
            $data = DB::table('lotcard')->join('produk', 'produk.tipe', '=', 'lotcard.modelno')->select('lotcard.barcode','lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.input1', 'lotcard.ng1', 'lotcard.name2', 'lotcard.status', 'produk.tempat')->where('produk.tempat', $request->tempat)->where('lotcard.lotno', $request->tanggal)->distinct('barcode')->get();
            return view('user.lotcard1', ['data' => $data, 'bagian' => $line]);
        }else {
            $line = DB::table('produk')->select('bagian')->distinct()->get();
            $data = DB::table('lotcard')->join('produk', 'produk.tipe', '=', 'lotcard.modelno')->select('lotcard.barcode','lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.input1', 'lotcard.ng1', 'lotcard.name2', 'lotcard.status', 'produk.tempat')->distinct('barcode')->get();
            return view('user.lotcard1', ['data' => $data, 'bagian' => $line]);
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
        $customPaper = array(0,0,225,600);
        $data0 = DB::table('lotcard')->where('barcode', $id)->get();
        $data1 = DB::table('lotcard')->where('barcode', $id)->select('barcode', 'modelno', 'lotno', 'shift', 'input1', 'ng1', 'date1', 'name1', 'input2', 'ng2', 'date2', 'name2')->distinct('barcode')->get();
        $pdf   = PDF::loadview('dll.lotdetail', ['data' => $data1, 'data1' => $data0]);
        $pdf->setPaper($customPaper);
	    return $pdf->stream();
    }

    public function lotsp($param0){
        $tipe = DB::table('rekapprod')->where('id', $param0)->select('tipe')->value('tipe');
        $keyid = DB::table('rekapprod')->where('id', $param0)->select('keyid')->value('keyid');
        $shift = DB::table('dataharian')->where('keyid', $keyid)->select('shift')->value('shift');

        $outer = DB::table('produk')->where('tipe', $tipe)->select('qtyouter')->value('qtyouter');
        $input1 = DB::table('rekapprod')->where('id', $param0)->select('fg')->value('fg');
        $input2 = DB::table('rekapprod')->where('id', $param0)->select('fg')->value('fg') / $outer;
        $ng1 = DB::table('rekapprod')->where('id', $param0)->select('ngp')->value('ngp');
        $pic = DB::table('dataharian')->where('keyid', $keyid)->select('pic')->value('pic');

        return view('user.lotcard', [
            'tipe' => $tipe, 'shift' => $shift, 'keyid' => $keyid, 
            'name' => $pic, 'ng' => $ng1, 'qty' => $input1, 'qty2' => $input2,
        ]);
    }

    public function lotsphps($id) {
        $resume = DB::table('rekapprod')->where('id', $id)->select('keyid')->value('keyid');
        DB::table('rekapprod')->where('id', $id)->delete();
        return redirect('/resume/'.$resume);
    }

    public function rubahlot($id){
        $status = DB::table('lotcard')->where('barcode', $id)->select('status')->distinct()->value('status');
        if ($status == 0) {
            $data0 = DB::table('lotcard')->where('barcode', $id)->where('barcode', $id)->select('barcode', 'modelno', 'lotno', 'shift', 'input1', 'input2', 'ng1', 'ng2', 'date1', 'date2', 'name1', 'name2')->distinct()->get();
            $data1 = DB::table('lotcard')->where('barcode', $id)->where('barcode', $id)->select('partname', 'nolot')->get();
            return view('user.rubahlot', ['data' => $data1, 'master' => $data0, 'i' => 1]);
        } 
        else {
            return back()->withInput()->withErrors(['msg', 'The Message']);
        }
    }

    public function rubahlots(Request $request){
        $status = DB::table('lotcard')->where('barcode', $request->keyid)->select('status')->distinct()->value('status');
        if ($status == 0) {
            DB::table('lotcard')->where('barcode', $request->keyid)->update([
                'input1' => $request->input1, 
                'ng1' => $request->ng1, 
                'date1' => $request->date1, 
                'name1' => $request->name1, 
                'input2' => $request->input2, 
                'ng2' => $request->ng2, 
                'date2' => $request->date2, 
                'name2' => $request->name2, 
            ]);
            if (DB::table('finish_job')->where('id', $request->keyid)->exists()) {
                $sisa = DB::table('finish_job')->select('Quantity')->where('id', $request->keyid)->value('Quantity') - $request->input1;
                if ($sisa == 0 ) {
                    $stts = 'Completed';
                }
                else {
                    $stts = 'Released';
                }
                DB::table('finish_job')->where('id', $request->keyid)->update([
                    'Status' => $stts, 
                    'Quantity Remained' => $sisa, 
                    'Overcompletion Quantity' => $request->input1, 
    
                ]);
            }
            return redirect('/cetaklot/'.$request->keyid);
        } 
        else {
            return redirect('/lotstatus')->withErrors(['msg', 'The Message']);
        }
    }

}
