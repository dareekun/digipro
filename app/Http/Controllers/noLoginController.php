<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class noLoginController extends Controller
{
    public function pwk(Request $request) {
        if ($request->tahuninput == '') {
            $month = date('m');
            $year  = date('Y');
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y');
        } else {
            $month = date('m', strtotime($request->tahuninput));
            $year  = date('Y', strtotime($request->tahuninput));
            $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $tanggal = date('F Y', strtotime($request->tahuninput));
        }
        $loss1 = DB::table('regulated_loss')->select('loss')->get();
        $loss2 = DB::table('work_loss')->select('loss')->get();
        $loss3 = DB::table('organization_loss')->select('loss')->get();
        $loss4 = DB::table('defect_loss')->select('loss')->get();
        $tipe  = DB::table('produk')->select('tipe')->where('tempat', $request->lineproduksi)->get();
        return view('exports.pwk', ['date' => $hari, 'bulan' => $tanggal, 'type' => $tipe, 'tipe' => $request->lineproduksi,
        'regloss' => $loss1, 'workloss' => $loss2, 'orgloss' => $loss3, 'defloss' => $loss4
        ]);
    }
}
