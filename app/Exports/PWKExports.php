<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\DB;

class PWKExports implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($date,$line)
    {
        $this->date = $date;
        $this->line = $line;
    }

    public function sheets(): array
    {
        $sheets = [];
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
        $sheets[] = DB::table('rekapprod')->leftJoin('dataharian', 'rekapprod.keyid', '=', 'dataharian.keyid')->leftJoin('produk', 'rekapprod.tipe', '=', 'produk.tipe')
        ->select('dataharian.tanggal as tanggal', 'dataharian.shift as shift', 'dataharian.line as Line_Produksi', 'rekapprod.tipe as ItemCode', 'rekapprod.daily_plan as Qty', 'rekapprod.ng_total as Defect', 'produk.time as Standar_Time')
        ->where('autosave', 'selesai')->get();

        $sheets[] = DB::table('rekapprod')->leftJoin('dataharian', 'rekapprod.keyid', '=', 'dataharian.keyid')->leftJoin('produk', 'rekapprod.tipe', '=', 'produk.tipe')
        ->select('dataharian.tanggal as tanggal', 'dataharian.shift as shift', 'dataharian.line as Line_Produksi', 'rekapprod.tipe as ItemCode', 'rekapprod.daily_plan as Qty', 'rekapprod.ng_total as Defect', 'produk.time as Standar_Time')
        ->where('autosave', 'selesai')->get();

        return $sheets;
    }
}
