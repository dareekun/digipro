<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PWKdownload implements FromView
{
    public $a;
    public $b;

    public function __construct($a, $b )
    {
        $this->tahuninput   = $a;
        $this->lineproduksi = $b;
    }

    public function view(): View
    {
        if ($this->tahuninput == '') {
            $month = date('m');
            $year  = date('Y');
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y');
        } else {
            $month = date('m', strtotime($this->tahuninput));
            $year  = date('Y', strtotime($this->tahuninput));
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y', strtotime($this->tahuninput));
        }
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
            $row11  = array();
            $row12  = array();
            $row13  = array(); //Std Time
            $row14  = array();
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

            $sub1a   = array(); //Regulated Loss

            $loss1 = DB::table('loss_type')->where('type', 'Fixed Loss')->select('loss')->get();
            $loss2 = DB::table('loss_type')->where('type', 'Work Loss')->select('loss')->get();
            $loss3 = DB::table('loss_type')->where('type', 'Organization Loss')->select('loss')->get();
            $loss4 = DB::table('loss_type')->where('type', 'Defect Loss')->select('loss')->get();
            $tipe  = DB::table('produk')->select('tipe', 'time')->where('tempat', $this->lineproduksi)->get();

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
                    $row1[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('waktukartap')->sum('waktukartap');
                    $row2[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->sum('otkartap');
                    $row3[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('waktukartap')->sum('waktukartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->sum('otkartap');;
                    $row5[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kartap')->sum('kartap');
                    $row6[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kwt')->sum('kwt');
                    $row4[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kartap')->sum('kartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kwt')->sum('kwt');
                    $row7[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('absenkartap')->sum('absenkartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('absenkwt')->sum('absenkwt');
                    $row8[]  = DB::table('hasil_prod')->leftJoin('dataharian', 'dataharian.keyid', '=', 'hasil_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))
                               ->where('dataharian.shift', 'Shift '.$n1)->select('hasil_prod.avalaible')->sum('hasil_prod.avalaible');
                    $row9[]  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkwt')->value('otkwt');
                    $row10[] = DB::table('hasil_prod')->leftJoin('dataharian', 'dataharian.keyid', '=', 'hasil_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                               ->select('hasil_prod.avalaible')->sum('hasil_prod.avalaible') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap') + 
                               DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkwt')->value('otkwt');
                    $row11[] = DB::table('dataharian')->join('hasil_prod', 'dataharian.keyid', '=', 'hasil_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                               ->select('hasil_prod.hasil')->sum('hasil_prod.hasil');
                    $row12[] = DB::table('dataharian')->join('rekap_prod', 'dataharian.keyid', '=', 'rekap_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                               ->select('rekap_prod.ng_total')->sum('rekap_prod.ng_total');
                    $row14[] = DB::table('dataharian')->join('hasil_prod', 'dataharian.keyid', '=', 'hasil_prod.keyid')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                               ->select('hasil_prod.phh')->sum('hasil_prod.phh');
                    // Data Hasil Produksi
                    // Repeated Job Calculated by For
                    $array11 = array();
                    foreach ($tipe as $tp) {
                    $array11[] = DB::table('dataharian')->leftJoin('rekap_prod', 'dataharian.keyid', '=', 'rekap_prod.keyid')
                    ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                    ->where('rekap_prod.tipe', $tp->tipe)
                    ->select('rekap_prod.daily_actual')->sum('rekap_prod.daily_actual');
                    }
                    $produk[] = $array11;
                    // Trouble Count 
                    // Repeated Job calculated by foreach
                    $array1  = array();
                    $array2  = array();
                    $array3  = array();
                    $array4  = array();
                    foreach ($loss1 as $type1) {
                        $array1[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type1->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->sum('dur');
                    }
                    foreach ($loss2 as $type2) {
                        $array2[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type2->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->sum('dur');
                    }
                    foreach ($loss3 as $type3) {
                        $array3[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type3->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->sum('dur');
                    }
                    foreach ($loss4 as $type4) {
                        $array4[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type4->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->sum('dur');
                    }
                    $lossa[] = $array1;
                    $lossb[] = $array2;
                    $lossc[] = $array3;
                    $lossd[] = $array4;
                    $sub1a[] = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->join('loss_type', 'loss_data.problem', 'loss_type.loss')->where('loss_type.remark', 'Regulated Loss')
                    ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->sum('dur');

                    // STD PROCESS TIME 
                    // Repeated Job calculated by foreach
                    $array5  = array();
                    $varow13 = DB::table('rekap_prod')->join('dataharian', 'dataharian.keyid', '=', 'rekap_prod.keyid')->join('produk', 'rekap_prod.tipe', 'produk.tipe')
                               ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                               ->select('rekap_prod.daily_actual as qty', 'produk.time as ct', 'produk.std_mp as mp')->get();
                    foreach ($varow13 as $var13) {
                        $array5[] = $var13->qty * ( $var13->ct / 60 ) * $var13->mp;
                    }
                    $row13[] = array_sum($array5);

                }
            }
            // return $sub1a;
            return view('exports.pwk', ['date' => $hari, 'bulan' => $tanggal, 'type' => $produk, 'lini' => $this->lineproduksi,
            'baris1' => $row1, 'baris2' => $row2, 'baris3' => $row3, 'baris4' => $row4, 'baris5' => $row5, 'baris6' => $row6, 'baris7' => $row7,
            'baris8' => $row8, 'baris9' => $row9, 'baris10' => $row10, 'baris11' => $row11, 'baris12' => $row12, 'baris13' => $row13, 
            'baris14' => $row14,
            'subloss1a' => $sub1a, 'regloss' => $lossa, 'workloss' => $lossb, 'orgloss' => $lossc, 'defloss' => $lossd,
            ]);
    }
}
