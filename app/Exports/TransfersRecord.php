<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class TransfersRecord implements FromView, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $record = DB::table('transaction')
        ->leftJoin('transfers', 'transaction.referTransfers', '=', 'transafers.refer')
        ->leftJoin('production', 'production.id', '=', 'transaction.productionId')
        ->leftJoin('product', 'production.model_no', '=', 'product.id')
        ->select('production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno',
        'transfers.transfers_date as transfers_date', 'transfers.item_type as item_type', 'transfers.item_qty as item_qty')
        ->orderBy('transfers.transfers_date', 'desc')->get();
        return view('exports.transfers_record', ['data' => $record, 'i' => 1]);
    }
}
