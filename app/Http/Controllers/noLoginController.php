<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PWKExports;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class noLoginController extends Controller
{
    public function pwk(Request $request) {
        if ($request->tahuninput == '') {
            $month = date('m');
            $year  = date('Y');
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y');
        } else {
            $month = date('m', strtotime($request->tahuninput));
            $year  = date('Y', strtotime($request->tahuninput));
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y', strtotime($request->tahuninput));
        }
        return Excel::download(new PWKExports($request->tahuninput), 'PWK - '.$tanggal.'.xlsx');
    }

    public function grafik($id) {
        $lini   = DB::table('produk')->where('bagian', $id)->select('tempat')->orderBy('tempat', 'asc')->distinct()->get();
        $plan   = array();
        $actual = array();
        $nowm   = date('m');
        $nowy   = date('Y');
            foreach ($lini as $ln) {
                $plan[]    = 0;
                }
            foreach ($lini as $li) {
                $actual[]  = DB::table('rekap_prod')->join('produk', 'rekap_prod.tipe', '=', 'produk.tipe')
                ->leftJoin('dataharian', 'dataharian.keyid', '=', 'rekap_prod.keyid')
                ->where('produk.bagian', $id)->where('produk.tempat', $li->tempat)->whereYear('dataharian.tanggal', $nowy)->whereMonth('dataharian.tanggal', '=', $nowm)->orderBy('produk.line', 'asc')->sum('rekap_prod.daily_actual');
            }
        return view('grafik', ['tipe' => $id, 'lini' => $lini, 'planning' => $plan, 'actual' => $actual]);
    }


    // Debugging Table 
    public function pwk2(Request $request) {
        if ($request->tahuninput == '') {
            $month = date('m');
            $year  = date('Y');
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y');
        } else {
            $month = date('m', strtotime($request->tahuninput));
            $year  = date('Y', strtotime($request->tahuninput));
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y', strtotime($request->tahuninput));
        }
        $data = DB::table('rekap_prod')->leftJoin('dataharian', 'rekap_prod.keyid', '=', 'dataharian.keyid')->leftJoin('produk', 'rekap_prod.tipe', '=', 'produk.tipe')
        ->select('dataharian.tanggal as tanggal', 'dataharian.shift as shift', 'dataharian.line as Line_Produksi', 'rekap_prod.tipe as ItemCode', 'rekap_prod.daily_plan as Qty', 'rekap_prod.ng_total as Defect', 'produk.time as Standar_Time')
        ->whereMonth('dataharian.tanggal', $month)->whereYear('dataharian.tanggal', $year)->where('autosave', 'selesai')->get();
        return $data;
    }

    // Debugging Table before export
    public function returnpwk(Request $request) {
        if ($request->tahuninput == '') {
            $month = date('m');
            $year  = date('Y');
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y');
        } else {
            $month = date('m', strtotime($request->tahuninput));
            $year  = date('Y', strtotime($request->tahuninput));
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y', strtotime($request->tahuninput));
        }
        if ($request->lineproduksi == '') {
            // Do Nothing
        } else {
            $row1   = array();
            $row2   = array();
            $row3   = array();
            $row4   = array();
            $row5   = array();
            $row6   = array();
            $row7   = array();
            $row8   = array();
            $row9   = array();
            $row10  = array();
            $lossa  = array();
            $lossb  = array();
            $lossc  = array();
            $lossd  = array();
            $array1 = array();
            $array2 = array();
            $array3 = array();
            $array4 = array();
            $array_tipe = array();
            $array_time = array();
            $produk = array();

            $loss1 = DB::table('loss_type')->where('type', 'Regulated Loss')->select('loss')->get();
            $loss2 = DB::table('loss_type')->where('type', 'Work Loss')->select('loss')->get();
            $loss3 = DB::table('loss_type')->where('type', 'Organization Loss')->select('loss')->get();
            $loss4 = DB::table('loss_type')->where('type', 'Defect Loss')->select('loss')->get();
            $tipe  = DB::table('produk')->select('tipe', 'time')->where('tempat', $request->lineproduksi)->get();

            foreach ($tipe as $tp) {
                $array_tipe[] = $tp->tipe;
                $array_time[] = $tp->time;
            }
            $produk[] = $array_tipe;
            $produk[] = $array_time;
            foreach ($loss1 as $type1) {
                $array1[] = $type1->loss;
            }
            foreach ($loss2 as $type2) {
                $array2[] = $type2->loss;
            }
            foreach ($loss3 as $type3) {
                $array3[] = $type3->loss;
            }
            foreach ($loss4 as $type4) {
                $array4[] = $type4->loss;
            }
            $lossa[] = $array1;
            $lossb[] = $array2;
            $lossc[] = $array3;
            $lossd[] = $array4;

            for ($i = 0; $i<$hari;$i++) {
                $i1 = $i+1;
                for($n = 0; $n<3; $n++) {
                    $n1 = $n+1;
                    $row1[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('waktukartap')->value('waktukartap');
                    $row2[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap');
                    $row3[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('waktukartap')->value('waktukartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap');;
                    $row5[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kartap')->value('kartap');
                    $row6[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kwt')->value('kwt');
                    $row4[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kartap')->value('kartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kwt')->value('kwt');
                    $row7[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('absenkartap')->value('absenkartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('absenkwt')->value('absenkwt');
                    $row8[]  = DB::table('hasil_prod')->leftJoin('dataharian', 'dataharian.keyid', '=', 'hasil_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))
                               ->where('dataharian.shift', 'Shift '.$n1)->select('hasil_prod.avalaible')->value('hasil_prod.avalaible');
                    $row9[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkwt')->value('otkwt');
                    $row10[] = DB::table('hasil_prod')->leftJoin('dataharian', 'dataharian.keyid', '=', 'hasil_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                               ->select('hasil_prod.avalaible')->value('hasil_prod.avalaible') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkwt')->value('otkwt');
                    // Data Hasil Produksi
                    // Repeated Job Calculated by For
                    $array11 = array();
                    foreach ($tipe as $tp) {
                    $array11[] = DB::table('dataharian')->leftJoin('rekap_prod', 'dataharian.keyid', '=', 'rekap_prod.keyid')
                    ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                    ->where('rekap_prod.tipe', $tp->tipe)
                    ->select('rekap_prod.daily_actual')->value('rekap_prod.daily_actual');
                    }
                    $produk[] = $array11;
                    $goodproductdaily = 
                    // Trouble Count 
                    // Repeated Job calculated by foreach
                    $array1 = array();
                    $array2 = array();
                    $array3 = array();
                    $array4 = array();
                    foreach ($loss1 as $type1) {
                        $array1[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type1->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                    }
                    foreach ($loss2 as $type2) {
                        $array2[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type2->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                    }
                    foreach ($loss3 as $type3) {
                        $array3[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type3->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                    }
                    foreach ($loss4 as $type4) {
                        $array4[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type4->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                    }
                    $lossa[] = $array1;
                    $lossb[] = $array2;
                    $lossc[] = $array3;
                    $lossd[] = $array4;
                }
            }
            // return $lossa;
            return view('exports.pwk', ['date' => $hari, 'bulan' => $tanggal, 'type' => $produk, 'lini' => $request->lineproduksi,
            'baris1' => $row1, 'baris2' => $row2, 'baris3' => $row3, 'baris4' => $row4, 'baris5' => $row5, 'baris6' => $row6, 'baris7' => $row7,
            'baris8' => $row8, 'baris9' => $row9, 'baris10' => $row10, 
            'regloss' => $lossa, 'workloss' => $lossb, 'orgloss' => $lossc, 'defloss' => $lossd,
            ]);
        }
    }
}
