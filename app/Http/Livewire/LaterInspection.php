<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LaterInspection extends Component
{

    public $search = "";
    public $datas = [];

    public function clear () {
        $this->search= "";
    }

    public function save($id, $index) {
        $packing   = $this->datas[$index]['packing'];
        $total_box = $this->datas[$index]['total_box'];
        $lot_size  = $this->datas[$index]['finish_goods'];
        $model_no  = DB::table('production')->where('barcode', $id)->value('model_no');
        DB::table('production')->where('barcode', $id)->update([
            'fg_1'   => $lot_size,
            'fg_2'   => $total_box,
        ]);
        DB::table('product')->where('id', $model_no)->update([
            'packing' => $packing
        ]);
        session()->flash('alerts', ['type' => 'alert-success', 'message' => 'Data Successfully Change']);
        $this->search= "";
    }

    public function render()
    {
        $this->datas = DB::table('production')
        ->leftJoin('product', 'product.id', '=', 'production.model_no')
        ->select('production.barcode as id', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 
        'production.fg_1 as finish_goods', 'production.fg_2 as total_box', 'product.packing as packing')
        ->where('production.barcode', 'like', '%'.$this->search.'%')
        ->orderBy('id', 'desc')->limit(10)->get();
        return view('livewire.later-inspection');
    }
}
