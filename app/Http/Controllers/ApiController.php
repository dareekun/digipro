<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            Lotcard::where('barcode', $id)->update([
                'status'=> 1,
                'scandate' => $date,
            ]);
    
            return response()->json([
                'status' => 'ok',
                'message' => 'Data was updated'
            ], 200);
        }
        
    }
}
