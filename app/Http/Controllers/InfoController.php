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
        $data = DB::table('dataharian')->rightJoin('resultprod', 'dataharian.keyid', '=', 'resultprod.keyid')->where('dataharian.bagian', $id)->get();
        return view('tabelline', ['data' => $data, 'tipe' => $id, 'line' => $lini]);
    }

    public function graph($id) {
        $lini   = DB::table('produk')->where('bagian', $id)->select('tempat')->orderBy('tempat', 'asc')->distinct()->get();
        $plan   = array();
        $actual = array();
        $nowm   = date('m');
        $nowy   = date('Y');
        $htts   = Http::get('http://158.118.35.24:8080/discreet')->status();
        if ($htts == 200) {
        $htta  = Http::get('http://158.118.35.24:8080/discreet')->getBody();
        $data0 = json_decode($htta, true);
        $count = count($data0);
        $sum = array();
        $total = 0;
            foreach ($lini as $ln) {
            $total = 0;
            $tipe = DB::table('produk')->where('tempat', $ln->tempat)->select('tipe')->get();
                foreach ($tipe as $tp) {
                    for ($i = 0; $i < $count; $i++) {
                        if ($data0[$i]['assembly_item_name'] == $tp->tipe){
                            $total = $total + $data0[$i]['plan_qty'];
                        break;
                        }
                    }
                }
            $plan[]    = $total;
            }
        }
        else {
            foreach ($lini as $ln) {
                $plan[]    = 0;
                }
        }
            foreach ($lini as $li) {
                $actual[]  = DB::table('rekapprod')->join('produk', 'rekapprod.tipe', '=', 'produk.tipe')
                ->leftJoin('dataharian', 'dataharian.keyid', '=', 'rekapprod.keyid')
                ->where('produk.bagian', $id)->where('produk.tempat', $li->tempat)->whereYear('dataharian.tanggal', $nowy)->whereMonth('dataharian.tanggal', '=', $nowm)->orderBy('produk.line', 'asc')->sum('rekapprod.daily_actual');
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
       return redirect('/home');
    }

    public function lotcard0() {
        $line   = DB::table('produk')->select('bagian')->distinct()->get();
        return view('user.lotcard0', ['line' => $line,]);
    }

    public function lotcardalpha(Request $request) {
        $parts = DB::table('parts')->where('modelno', $request->tipe)->get();
        $shift = DB::table('waktu')->select('shift')->get();
        return view('user.lotcardalpha', ['data' => $parts, 'shift' => $shift, 'option' => $request->tipe, 'i' => 1, 'jobid' => '']);
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
            ->select('lotcard.modelno as type', 'lotcard.lotno as nolot' , 'produk.qtyouter as qtyouter', 'lotcard.input2 as totalbox', 'lotcard.input1 as totalqty', 'lotcard.ng1 as ng')
            ->where('lotcard.status', 1)->distinct()->get();
        return view('user.lotscaned', ['data' => $data]);
    }

    public function dellot($id) {
        DB::table('lotcard')->where('barcode', $id)->delete();
        DB::table('finish_job')->where('id', $id)->delete();
        return redirect('/lotstatus');
    }

    public function plusalpha(Request $request) {
        $date  = base_convert(date("ymdhms", strtotime($request->tanggal)),10,32);
        $lotid = strtoupper($date);
        $parts = $request->part;
        $lotparts = $request->lotpart;
        if (isset($request->part)) {
            for ($htng = 0; $htng < count($parts); $htng++) {
                $data = array(
                'id' => $lotid.str_pad($htng, 2, '0', STR_PAD_LEFT),
                'barcode' => $lotid,
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
        $year = date('Y');
        $month = date('m') - 1;
        if (isset($request->tempat)) {
            $line = DB::table('produk')->select('bagian')->distinct()->get();
            $data = DB::table('lotcard')->join('produk', 'produk.tipe', '=', 'lotcard.modelno')->select('lotcard.barcode','lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.input1', 'lotcard.ng1', 'lotcard.name2', 'lotcard.status', 'produk.tempat')->whereYear('lotcard.lotno', $year)->whereMonth('lotcard.lotno', '>', $month)->where('produk.tempat', $request->tempat)->where('lotcard.lotno', $request->tanggal)->distinct('barcode')->get();
            return view('user.lotcard1', ['data' => $data, 'bagian' => $line]);
        }else {
            $line = DB::table('produk')->select('bagian')->distinct()->get();
            $data = DB::table('lotcard')->join('produk', 'produk.tipe', '=', 'lotcard.modelno')->whereYear('lotcard.lotno', $year)->whereMonth('lotcard.lotno', '>', $month)->select('lotcard.barcode','lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.input1', 'lotcard.ng1', 'lotcard.name2', 'lotcard.status', 'produk.tempat')->distinct('barcode')->get();
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
        $customPaper = array(0,0,245,600);
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
        $input1 = DB::table('rekapprod')->where('id', $param0)->select('ttlprod')->value('ttlprod');
        $input2 = DB::table('rekapprod')->where('id', $param0)->select('ttlprod')->value('ttlprod') / $outer;
        $ng1 = 0;
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
