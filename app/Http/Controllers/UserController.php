<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

use Illuminate\Support\Facades\Http;

use App\User;
Use Redirect;
use Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function menu(){
        $menu = DB::table('produk')->select('bagian')->distinct()->orderBy('bagian')->pluck('bagian');
        return $menu;
    }
    public function input0($id){
        $s1     = Auth::user();
        $line   = DB::table('produk')->where('bagian', $id)->select('tempat')->distinct()->orderBy('tempat')->get();
        $waktu  = DB::table('waktu')->select('shift', 'value')->get();
        $stat   = DB::table('dataharian')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        $data   = DB::table('dataharian')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('keyid')->distinct()->value('keyid');
        return view('user.data', ['bagian' => $id, 'line' => $line, 'waktu' => $waktu, 'status' => $stat, 'data' => $data]);
    }
    public function next(Request $request) {
        $s0 = DB::table('waktu')->select('start')->where('shift', $request->shift)->value('start');
        $s1 = DB::table('waktu')->select('finish')->where('shift', $request->shift)->value('finish');
        $s2 = DB::table('waktu')->select('duration')->where('shift', $request->shift)->value('duration');
        $s4 = DB::table('waktu')->select('value')->where('shift', $request->shift)->value('value');
        $s3 = Auth::user();
        $keyid = strtoupper(base_convert($s3->id.date('YmdHis'),10,32));
        $id = DB::table('produk')->select('bagian')->distinct()->where('tempat', $request->line)->value('bagian');
        DB::table('dataharian') ->insert([
            'keyid' => $keyid,
            'bagian' => $id,
            'tanggal' => $request->tanggal,
            'line'=> $request->line,
            'pic' => $request->pic,
            'shift' => $request->shift,
            'kartap' => $request->kartap,
            'absenkartap' => $request->absenkartap,
            'waktukartap' => $s2,
            'otkartap' => $request->otkartap,
            'kwt' => $request->kwt,
            'absenkwt' => $request->absenkwt,
            'waktukwt' => $s2,
            'otkwt' => $request->otkwt,
            'izin' => $request->izin,
            'optplan' => $request->kartap + $request->kwt,
            'start' => $s0,
            'finish' => $s1,
            'waktukerja' => ($s2 * $request->kartap) + ($s2 * $request->kwt) + $request->otkartap + $request->otkwt + $request->waktumasuk - $request->waktukeluar,
            'bantuan_masuk' => $request->bantuanmasuk,
            'bantuan_keluar' => $request->bantuankeluar,
            'bantuan_masuk_waktu' => $request->waktumasuk,
            'bantuan_keluar_waktu' => $request->waktukeluar,
            'lastedit' => $s3->username,
            'autosave' => 'belum',
        ]);
        return redirect('/resume/'.$keyid);
    }
    public function refresh($id) {
        $s1 = DB::table('dataharian')->select('bagian')->where('keyid', $id)->value('bagian');
        DB::table('dataharian')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('rekap_prod')->where('keyid', $id)->delete();
        return redirect('/data/'.$s1);
    }
    public function resume($id) {
        $s1 = Auth::user();
        $s2 = DB::table('dataharian')->select('bagian')->where('keyid', $id)->distinct()->value('bagian');
        $s3 = DB::table('dataharian')->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        if ($s3 == 'selesai') {
            return redirect('/data/'.$bagian);
        }
        $data  = DB::table('dataharian')->where('keyid', $id)->get();
        $bline = DB::table('produk')->where('bagian', $s2)->select('tempat')->distinct()->orderBy('tempat')->get();
        $waktu = DB::table('waktu')->select('shift')->get();
        $p1 = DB::table('rekap_prod')->select('id')->where('keyid', $id)->where('status', 0)->where('lastedit', $s1->username)->value('id');
        return view('user.data2', ['bagian' => $s2, 'data' => $data, 'bline' => $bline, 'waktu' => $waktu, 'refer' => $id, 'tagkey' => $p1]);
    }
    // ===================================================
    // ================= H A R I A N 2 ===================
    // ===================================================
    public function next2(Request $request) {
        $s1 = Auth::user();
        $s2 = DB::table('waktu')->where('shift', $request->shift)->select('duration')->value('duration');
        DB::table('dataharian')->where('keyid', $request->subaru)->update([
            'tanggal' => $request->tanggal,
            'line'=> $request->line,
            'pic' => $request->pic,
            'shift' => $request->shift,
            'kartap' => $request->kartap,
            'absenkartap' => $request->absenkartap,
            'waktukartap' => $s2,
            'otkartap' => $request->otkartap,
            'kwt' => $request->kwt,
            'absenkwt' => $request->absenkwt,
            'waktukwt' => $s2,
            'otkwt' => $request->otkwt,
            'izin' => $request->izin,
            'optplan' => $request->optplan,
            'start' => $request->start,
            'finish' => $request->finish,
            'waktukerja' => ($s2 * $request->kartap) + ($s2 * $request->kwt) + $request->otkartap + $request->otkwt + $request->waktumasuk - $request->waktukeluar,
            'bantuan_masuk' => $request->bantuanmasuk,
            'bantuan_keluar' => $request->bantuankeluar,
            'bantuan_masuk_waktu' => $request->waktumasuk,
            'bantuan_keluar_waktu' => $request->waktukeluar,
            'lastedit' => $s1->username,
        ]);
        return redirect('/resume/'.$request->subaru);
    }
    public function hapusdataproduk($id){
        $alamat = DB::table('dataharian')->where('keyid', $id)->select('bagian')->value('bagian');
        DB::table('dataharian')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('loss_data')->where('keyid', $id)->delete();
        DB::table('resultprod')->where('keyid', $id)->delete();
        DB::table('rekap_prod')->where('keyid', $id)->delete();
        return redirect('/tabel/'.$alamat);
    }
    
    public function detail($id) {
        $a = DB::table('dataharian')->where('keyid', $id)->get();
        $b = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Regulated Loss')->where('keyid', $id)->get();
        $c = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Work Loss')->where('keyid', $id)->get();
        $d = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Organization Loss')->where('keyid', $id)->get();
        $e = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('type', 'Defect Loss')->where('keyid', $id)->get();
        $f = DB::table('rekap_prod')->where('keyid', $id)->get();
        $g = DB::table('hasil_prod')->where('keyid', $id)->get();
        return view('admin.detail', ['data1' => $a, 'data2' => $b, 'data3' => $c, 'data4' => $d, 'data5' => $e, 'data6' => $f, 'data7' => $g, 'id' => $id]);
}

public function change_password() {

}

public function add_lotcard() {

}
}