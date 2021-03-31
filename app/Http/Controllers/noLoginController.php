<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class noLoginController extends Controller
{
    public function pwk(Request $request) {
        $month = date('m', strtotime($request->tahuninput));
        $year  = date('Y', strtotime($request->tahuninput));
        $hari  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $tanggal = date('m Y', strtotime($request->tahuninput));
        return view('exports.pwk', ['date' => $hari, 'bulan' => $tanggal]);
    }
}
