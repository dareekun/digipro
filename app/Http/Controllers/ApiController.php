<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    public function show($id)
    {
        $data = DB::table('lotcard')->where('barcode', $id)
        ->select('lotcard.barcode', 'lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.name2', 'lotcard.input1', 'lotcard.input2', 'lotcard.status' )
        ->distinct()->first();
        return response()->json($data);
    }

    public function reverse($id)
    {
        DB::table('lotcard')->where('barcode', $id)->update(['status'=> 0]);
        return response()->json([
            'status' => 'Ok',
            'message' => 'Data was Reverse'
        ], 200);
    }

    public function update($id, $jumlah)
    {
        $check = DB::table('lotcard')->where('barcode', $id)->select('status')->distinct()->value('status');
        if ($check == 1) {
            return response()->json([
                'status' => 'Replace',
                'message' => 'Data Already Been Proccess'
            ], 200);
        }
        else {
            $date = date('Y-m-d');
            DB::table('lotcard')->where('barcode', $id)->update([
                'status' => 1,
                'input1' => $jumlah,
                'input2' => $jumlah,
            ]);
            return response()->json([
                'status' => 'Ok',
                'message' => 'Data was updated'
            ], 200);
        }
    }

    public function data_product(Request $request) {
        $data = DB::table('product')->where('id', $request->id)->get();
        return $data;
    }

    public function json_data1(Request $request)
    {
        $data1 = DB::table('produk')->where('section', $request->get('bag'))->orderBy('line', 'asc')->distinct()->pluck('line');
        return response()->json($data1);
    }
    public function json_data2(Request $request)
    {
        $data2 = DB::table('produk')->where('line', $request->get('temt'))->pluck('model_no');
        return response()->json($data2);
    }
}