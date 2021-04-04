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
            $loss1 = DB::table('loss_type')->where('type', 'Regulated Loss')->select('loss')->get();
            $loss2 = DB::table('loss_type')->where('type', 'Work Loss')->select('loss')->get();
            $loss3 = DB::table('loss_type')->where('type', 'Organization Loss')->select('loss')->get();
            $loss4 = DB::table('loss_type')->where('type', 'Defect Loss')->select('loss')->get();
            $tipe  = DB::table('produk')->select('tipe', 'time')->where('tempat', $this->line)->get();
            return view('exports.pwk', ['date' => $hari, 'bulan' => $tanggal, 'type' => $tipe, 'tipe' => $this->line,
            'regloss' => $loss1, 'workloss' => $loss2, 'orgloss' => $loss3, 'defloss' => $loss4,
            ]);
        }
    }
}
