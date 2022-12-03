<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\DetailData;
use App\Exports\Sheets\RecapData;
use Illuminate\Support\Facades\DB;

class FinishProduction implements WithMultipleSheets
{
    
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new RecapData();
        $record = DB::table('product')->select('line')->distinct()->get();
        foreach ($record as $rcd) {
            $sheets[] = new DetailData($rcd->line);
        }
        return $sheets;
    }
}
