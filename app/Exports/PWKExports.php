<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\InputResultSheet;
use App\Exports\Sheets\InputTimeSheet;

class PWKExports implements  WithMultipleSheets
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($date)
    {
        $this->date = $date;
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
        $sheets[] = new InputResultSheet($year, $month);
        $sheets[] = new InputTimeSheet($year, $month);
        return $sheets;
    }
}
