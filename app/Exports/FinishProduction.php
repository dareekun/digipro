<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class FinishProduction implements FromView, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $record = DB::table('production')->where('status', '>', 0)->leftJoin('quality', 'production.id', '=', 'quality.productionId')
        ->leftJoin('product', 'product.id', '=', 'production.model_no')->leftJoin('users', 'quality.userId', '=', 'users.id')
        ->select('production.barcode as id', 'product.section as section', 'product.line as line', 'product.model_no as model_no',
        'production.lotno as lotno', 'production.shift as shift', 'production.fg_1 as finish_goods',
        'quality.judgement as judgement', 'users.name as checker')->get();
        return view('exports.finish_data', ['data' => $record, 'i' => 1]);
    }
}
