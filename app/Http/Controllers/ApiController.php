<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function show($id)
    {
        return Lotcard::where('barcode', $id)->select('barcode', 'modelno', 'lotno', 'shift', 'name2', 'input2')->distinct()->first();
    }

    public function reverse($id)
    {
        Lotcard::where('barcode', $id)->update(['status'=> 0]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Data was Reverse'
        ], 200);
    }

    public function update($id)
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
                'status'=> 1,
                'scandate' => $date,
            ]);
            $tanggal = date('Y-m-d G:I:s');
            DB::table('lotcard')->where('barcode', $id)->update([
                'tanda'=> 1,
                'Completion Date' => $tanggal,
                'Transaction Date' => $tanggal,
            ]);
    
            return response()->json([
                'status' => 'ok',
                'message' => 'Data was updated'
            ], 200);
        }
        
    }
}