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

    public function test(){
        $htta  = Http::get('http://158.118.35.22:8080/discreet')->getBody();
        $data0 = json_decode($htta, true);
        $data1 = json_decode(DB::table('produk')->get(), true);
        $total0 = count($data0);
        $total1 = count($data1);
        for ($i = 0; $i < $total0; $i++) {
            for ($a = 0; $a < $total1; $a++) {
                if ($data0[$i]['assembly_item_name'] == $data1[$a]['tipe']){
                        $data0[$i]['bagian'] = $data1[$a]['bagian'];
                        $data0[$i]['line'] = $data1[$a]['tempat'];
                break;
                }
                else {
                    $data0[$i]['bagian'] = "";
                    $data0[$i]['line'] = "";
                }
            }
        }
        // return $data0;
        return view('user.planning',['data' => $data0, 'tipe' => '', 'i' => 1]);
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