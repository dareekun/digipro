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
        ->leftJoin('finish_job', 'lotcard.barcode', '=', 'finish_job.id')
        ->select('lotcard.barcode', 'lotcard.modelno', 'lotcard.lotno', 'lotcard.shift', 'lotcard.name2', 'lotcard.input1', 'lotcard.input2', 
        'finish_job.Job as job', 'finish_job.Quantity as plan', 'finish_job.Quantity Remained as qty', 'lotcard.status' )
        ->distinct()->first();
        return response()->json($data);
    }

    public function reverse($id)
    {
        Lotcard::where('barcode', $id)->update(['status'=> 0]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Data was Reverse'
        ], 200);
    }

    public function update($id, $jumlah)
    {
        $check = DB::table('lotcard')->where('barcode', $id)->select('status')->distinct()->value('status');
        $plan  = DB::table('finish_job')->where('id', $id)->select('Quantity')->distinct()->value('Quantity');
        $tanda = DB::table('finish_job')->where('id', $id)->select('tanda')->distinct()->value('tanda');
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
            ]);
            if ($tanda == 0) {
                $tanggal = date('Y-m-d G:I:s');
                $planqty = $plan;
                $sisa = $planqty - $jumlah;
                if ($sisa = 0) {
                    $status = 'Completed';
                } else {
                    $status = 'Released';
                }
            } else {
                $tanggal = date('Y-m-d G:I:s');
                $sisa = 0;
                $status = 'Completed';
                $planqty = $jumlah;
            }
            DB::table('finish_job')->where('barcode', $id)->update([
                'tanda'=> $tanda + 2,
                'Completion Date' => $tanggal,
                'Transaction Date' => $tanggal,
                'Quantity' => $planqty,
                'Status' => $status, 
                'Overcompletion Quantity' => $jumlah, 
                'Quantity Remained' => $sisa
            ]);
    
            return response()->json([
                'status' => 'ok',
                'message' => 'Data was updated'
            ], 200);
        }
        
    }
}