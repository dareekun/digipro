<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

use App\User;
use Auth;
Use Redirect;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    
    public function users_control () {
        return view('admin.users_control');
    }
    public function product_control () {
        return view('admin.product_control');
    }
    public function department_control () {
        return view('admin.department_control');
    }

    // =====================================
    // ============ P R O D U K ============
    // =====================================

    public function produk() {
        $produk = DB::table('produk')->get();
        $bagian = DB::table('produk')->select('bagian')->distinct()->get();
        $line = DB::table('produk')->select('tempat')->distinct()->get();
        return view('admin.produk', ['data' => $produk, 'bagian' => $bagian, 'list' => $line]);
    }

    public function detailproduk($tipe) {
        $parts = DB::table('parts')->where('modelno', $tipe)->get();
        return view('admin.detailproduk', ['data' => $parts, 'tipe' => $tipe]);
    }

    public function hapusparts($id) {
        $modelno = DB::table('parts')->select('modelno')->where('id', $id)->value('modelno');
        $parts = DB::table('parts')->where('id', $id)->delete();
        return redirect('/admin/produk/'.$modelno);
    }

    public function produkdirubah(Request $request) {
        DB::table('produk')->where('id', $request->edittag0)->update([
            'tipe' => $request->edittag3,
            'bagian' => $request->edittag1,
            'tempat' => $request->edittag2,
            'time' => $request->edittag4,
            'std_mp' => $request->edittag5
        ]);
        return redirect('/admin/produk');
    }

    public function produkditambah(Request $request) {
        DB::table('produk')->insert([
            'tipe' => $request->tag3,
            'bagian' => $request->tag1,
            'tempat' => $request->tag2,
            'time' => $request->tag4,
            'std_mp' => $request->tag5
        ]);
        return redirect('/admin/produk');
    }
    public function produkdihapus(Request $request) {
        DB::table('produk')->where('id', $request->idhapus)->delete();
        return redirect('/admin/produk');
    }

    // =====================================
    // =========== M A S A L A H ===========
    // =====================================

    public function masalah() {
        $i = 1;
        $uni0 = DB::table('loss_type')->orderBy('id', 'asc')->get();
        $uni1 = DB::table('loss_type')->select('type')->distinct()->get();
        return view('admin.masalah', ['i' => $i, 'data' => $uni0, 'problemtype' => $uni1]);
    }

    public function masalahditambah(Request $request){
        $database = $request->jenis;
            DB::table('loss_type')->insert([
                'loss' => $request->masalah,
                'type' => $request->type,
                'remark' => $request->remark,
            ]);
        return redirect('/pengaturan/masalah');
    }

    public function masalahdirubah(Request $request) {
            DB::table('loss_type')->where('id', $request->paramedit0)->update([
                'type' => $request->paramedit1,
                'loss' => $request->paramedit2,
                'remark' => $request->paramedit3,
            ]);
        return redirect('/pengaturan/masalah');
    }

    public function masalahdihapus(Request $request){
        DB::table('loss_type')->where('id', $request->param2)->delete();
        return redirect('/pengaturan/masalah');
    }

    // =====================================
    // ============= S H I F T =============
    // =====================================

    public function shift() {
        $index = 1;
        $data = DB::table('waktu')->get();
        $list = DB::table('waktu')->select('value')->distinct()->get();
        return view('admin.shift', ['data' => $data, 'i' =>$index, 'list' => $list]);
    }

    public function shiftditambah(Request $request) { 
        DB::table('waktu')->insert([
            'shift' => $request->nama,
            'value' => $request->posisi,
            'start' => $request->start,
            'finish' => $request->finish,
            'duration' => $request->duration
        ]);
        return redirect('/pengaturan/shift');
    }

    public function shiftdiedit(Request $request){
        DB::table('waktu')->where('id', $request->idedit)->update([
            'shift' => $request->shiftedit,
            'value' => $request->posisiedit,
            'start' => $request->startedit,
            'finish' => $request->finishedit,
            'duration' => $request->duration
        ]);
        return redirect('/pengaturan/shift');
    }

    public function shiftdihapus(Request $request){
        DB::table('waktu')->where('id', $request->idhapus)->delete();
        return redirect('/pengaturan/shift');
    }
}
