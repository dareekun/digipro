<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ManagerController extends Controller
{
    public function informasi() {
        $inf1 = DB::table('informasi')->select('info1')->value('info1');
        $inf2 = DB::table('informasi')->select('info2')->value('info2');
        $inf3 = DB::table('informasi')->select('info3')->value('info3');
        $inf4 = DB::table('informasi')->select('info4')->value('info4');
        $inf5 = DB::table('informasi')->select('info5')->value('info5');
        $inf6 = DB::table('informasi')->select('info6')->value('info6');
        $inf7 = DB::table('informasi')->select('info7')->value('info7');
        $inf8 = DB::table('informasi')->select('info8')->value('info8');
        $inf9 = DB::table('informasi')->select('info9')->value('info9');
        $inf10 = DB::table('informasi')->select('info10')->value('info10');
        return view('manager.informasi', [
            'info1' => $inf1,
            'info2' => $inf2,
            'info3' => $inf3,
            'info4' => $inf4,
            'info5' => $inf5,
            'info6' => $inf6,
            'info7' => $inf7,
            'info8' => $inf8,
            'info9' => $inf9,
            'info10' => $inf10,
        ]);
    }

    public function informasiupdate(Request $request) {
        DB::table('informasi')->where('tanda', 'ter')->update([
            'info1' => $request->info1,
            'info2' => $request->info2,
            'info3' => $request->info3,
            'info4' => $request->info4,
            'info5' => $request->info5,
            'info6' => $request->info6,
            'info7' => $request->info7,
            'info8' => $request->info8,
            'info9' => $request->info9,
            'info10' => $request->info10,
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/manager/Informasi');
    }

    public function test() {
        $htta   = Http::get('http://158.118.35.24:8080/discreet')->getBody();
        return $htta;
    }
}
