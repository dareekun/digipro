<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PWKExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($date,$line)
    {
        $this->date = $date;
        $this->line = $line;
    }

    public function view(): View
    {
        if ($this->date == '') {
            $month = date('m');
            $year  = date('Y');
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y');
        } else {
            $month = date('m', strtotime($this->date));
            $year  = date('Y', strtotime($this->date));
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y', strtotime($this->date));
        }
        if ($this->line == '') {
            // Do Nothing
        } else {
            $row1  = array();
            $row2  = array();
            $row3  = array();
            $row4  = array();
            $row5  = array();
            $row6  = array();
            $row7  = array();
            $row8  = array();
            $row9  = array();
            $row10 = array();

            $lossa = array();
            $lossb = array();
            $lossc = array();
            $lossd = array();

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
            $tipe  = DB::table('produk')->select('tipe', 'time')->where('tempat', $this->line)->get();

            foreach ($tipe as $tp) {
                array_push($array_tipe, $tp->tipe);
                array_push($array_time, $tp->time);
            }
            array_push($produk, $array_tipe);
            array_push($produk, $array_time);

            foreach ($loss1 as $type1) {
                array_push($array1, $type1->loss);
            }
            foreach ($loss2 as $type2) {
                array_push($array2, $type2->loss);
            }
            foreach ($loss3 as $type3) {
                array_push($array3, $type3->loss);
            }
            foreach ($loss4 as $type4) {
                array_push($array4, $type4->loss);
            }
            array_push($lossa, $array1);
            array_push($lossb, $array2);
            array_push($lossc, $array3);
            array_push($lossd, $array4);

            for ($i = 0; $i<$hari;$i++) {
                $i1 = $i+1;
                for($n = 0; $n<3; $n++) {
                    $n1 = $n+1;

                    $workingtime = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('waktukartap')->value('waktukartap');
                    $overtime    = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap');
                    $totaltime   = $workingtime + $overtime;
                    $kartap      = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kartap')->value('kartap');
                    $kwt         = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('kwt')->value('kwt');
                    $totalhadir  = $kartap + $kwt;
                    $akrt        = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('absenkartap')->value('absenkartap');
                    $akwt        = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('absenkwt')->value('absenkwt');
                    $absen       = $akrt + $akwt;

                    $avail = DB::table('resultprod')->leftJoin('dataharian', 'dataharian.keyid', '=', 'resultprod.keyid')
                    ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('resultprod.avalaible')->value('resultprod.avalaible');

                    $otkrt  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkartap')->value('otkartap');
                    $otkwt  = DB::table('dataharian')->where('tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('shift', 'Shift '.$n1)->select('otkwt')->value('otkwt');
                    $ot     = $otkrt + $otkwt;
                    $ttlwrk = $avail + $ot;
                    array_push($row1, $workingtime);
                    array_push($row2, $overtime);
                    array_push($row3, $totaltime);
                    array_push($row5, $kartap);
                    array_push($row6, $kwt);
                    array_push($row4, $totalhadir);
                    array_push($row7, $absen);
                    array_push($row8, $avail);
                    array_push($row9, $ot);
                    array_push($row10, $ttlwrk);

                    // Data Hasil Produksi
                    // Repeated Job Calculated by For
                    $array11 = array();
                    foreach ($tipe as $tp) {
                    $hasil = DB::table('dataharian')->leftJoin('rekapprod', 'dataharian.keyid', '=', 'rekapprod.keyid')
                    ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)
                    ->where('rekapprod.tipe', $tp->tipe)
                    ->select('rekapprod.ttlprod')->value('rekapprod.ttlprod');
                    array_push($array11, $hasil);
                    }
                    array_push($produk, $array11);


                    // Trouble Count 
                    // Repeated Job calculated by foreach
                    $array1 = array();
                    $array2 = array();
                    $array3 = array();
                    $array4 = array();
                    foreach ($loss1 as $type1) {
                        $pusha = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type1->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                        array_push($array1, $pusha);
                    }
                    foreach ($loss2 as $type2) {
                        $pushb = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type2->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                        array_push($array2, $pushb);
                    }
                    foreach ($loss3 as $type3) {
                        $pushc = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type3->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                        array_push($array3, $pushc);
                    }
                    foreach ($loss4 as $type4) {
                        $pushd = DB::table('dataharian')->rightJoin('loss_data', 'dataharian.keyid', '=', 'loss_data.keyid')->where('problem', $type4->loss)
                        ->where('dataharian.tanggal', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i1)))->where('dataharian.shift', 'Shift '.$n1)->select('dur')->value('dur');
                        array_push($array4, $pushd);
                    }
                    array_push($lossa, $array1);
                    array_push($lossb, $array2);
                    array_push($lossc, $array3);
                    array_push($lossd, $array4);
                }
            }
            // return $produk;
            return view('exports.pwk', ['date' => $hari, 'bulan' => $tanggal, 'type' => $produk, 'lini' => $this->line,
            'baris1' => $row1, 'baris2' => $row2, 'baris3' => $row3, 'baris4' => $row4, 'baris5' => $row5, 'baris6' => $row6, 'baris7' => $row7,
            'baris8' => $row8, 'baris9' => $row9, 'baris10' => $row10, 
            'regloss' => $lossa, 'workloss' => $lossb, 'orgloss' => $lossc, 'defloss' => $lossd,
            ]);
        }
    }
}
