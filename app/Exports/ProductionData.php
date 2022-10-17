<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProductionData implements FromView, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $record = DB::table('production')->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
        ->select('production.barcode as id', 'production.lotno as lotno', 'production.shift as shift', 'product.model_no as model_no', 'production.fg_1 as finish_goods',
        'production.ng_1 as not_goods', 'production.name_1 as pic', 'quality.judgement as judgement')->get();
        return view('exports.production_data', ['data' => $record, 'i' => 1]);
    }
}
