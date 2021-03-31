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
    public function detail($id) {

        if ( strstr( $id, 'CM' ) || strstr( $id, 'IM' )) {
            $a = DB::table('datamasin')->where('keyid', $id)->get();
            $b = DB::table('regloss')->where('keyid', $id)->get();
            $c = DB::table('stoploss')->where('keyid', $id)->get();
            $d = DB::table('abloss')->where('keyid', $id)->get();
            $e = DB::table('defloss')->where('keyid', $id)->get();
            $g = DB::table('resultmesin')->where('keyid', $id)->get();
            return view('admin.mesin', ['data1' => $a, 'data2' => $b, 'data3' => $c, 'data4' => $d, 'data5' => $e, 'data7' => $g, 'id' => $id]);
        }
        else {
            $a = DB::table('dataharian')->where('keyid', $id)->get();
            $b = DB::table('regloss')->where('keyid', $id)->get();
            $c = DB::table('workloss')->where('keyid', $id)->get();
            $d = DB::table('orloss')->where('keyid', $id)->get();
            $e = DB::table('defloss')->where('keyid', $id)->get();
            $f = DB::table('rekapprod')->where('keyid', $id)->get();
            $g = DB::table('resultprod')->where('keyid', $id)->get();
            return view('admin.detail', ['data1' => $a, 'data2' => $b, 'data3' => $c, 'data4' => $d, 'data5' => $e, 'data6' => $f, 'data7' => $g, 'id' => $id]);
        }
    }

    public function daftar(Request $request) {
        $s1 = Auth::user();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ];
        $this->validate($request, $rules);
        if ($s1->dept=='developer') {
            $dept = $request->dept;
        }
        else {
            $dept = $s1->dept;
        }
        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'dept' => $dept,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/admin/pengaturan');
    }

    public function urus() {
        $s1 = Auth::user();
        if ($s1->role == 'developer') {
            $data = DB::table('users')->where('role', '<>', 'developer')->get();
        }
        else if ($s1->role == 'manager') {
            $data = DB::table('users')->where('role', '<>', 'developer')->where('role', '<>', 'manager')->where('dept', $s1->dept)->get();
        }
        else {
            $data = DB::table('users')->where('role', '<>', 'developer')->where('role', '<>', 'manager')->where('role', '<>', 'admin')->where('dept', $s1->dept)->get();
        }
        return view('auth.pengaturan', ['data' => $data]);
    }

    public function delaku(Request $request) {
        $s1 = Auth::user();
        $data = DB::table('users')->where('username', $request->data0)->get();
        $role = DB::table('users')->select('role')->where('username', $request->data0)->value('role');
        $dept = DB::table('users')->select('dept')->where('username', $request->data0)->value('dept');
        $rules = [
            'password' => ['required', 'string', 'confirmed'],
        ];
        $message = ['password.confirmed' => 'Password Tidak Sama',];
        $this->validate($request, $rules, $message);
        if (Hash::check($request->password, $s1->password)) {
            
            if ($s1->role == 'developer') {
                if ($role == "developer") {
                    return redirect('/home');
                }
                else {
                    DB::table('users')->where('username', $request->data0)->delete();
                }
            }
            elseif ($s1->dept != $dept) {
                return redirect('/home');
            }
            else {
                if ($s1->role == 'manager') {
                    if ($role == "manager" || $role == "developer") {
                        return redirect('/home');
                    }
                    else {
                        DB::table('users')->where('username', $request->data0)->delete();
                    }
                }
                elseif ($s1->role == 'admin') {
                    if ($role == "developer" || $role == "manager" || $role == "admin") {
                        return redirect('/home');
                    }
                    else {
                        DB::table('users')->where('username', $request->data0)->delete();
                    }
                }
                else {
                    return redirect('/home');
                }
            }
            $errors = ['oldpass' => ['Akun Berhasil Di Hapus']]; 
            return Redirect::back()->withErrors($errors);
        }

        if(strcmp($request->password, $s1->password) == 1){
            $errors = ['username' => ['Password Salah']]; 
            return Redirect::back()->withErrors($errors);
                }
        else {

        }
    }

    public function changep(Request $request) {
        $s1 = Auth::user();
        $data = DB::table('users')->where('username', $request->data0)->get();
        $role = DB::table('users')->select('role')->where('username', $request->data0)->value('role');
        $dept = DB::table('users')->select('dept')->where('username', $request->data0)->value('dept');
        $rules = [
            'password' => ['required', 'string', 'confirmed'],
        ];
        $message = ['password.confirmed' => 'Password Tidak Sama',];
        $this->validate($request, $rules, $message);
        if (Hash::check($request->pass, $s1->password)) {
            
            if ($s1->role == 'developer') {
                if ($role == "developer") {
                    $errors = ['oldpass' => ['Pelanggaran']]; 
                    return Redirect::back()->withErrors($errors);
                }
                else {
                    DB::table('users')->where('username', $request->data0)->update(
                        [
                            'password' => bcrypt($request->password),
                        ]   
                    );
                }
            }
            elseif ($s1->dept != $dept) {
                return redirect('/home');
            }
            else{
                if ($s1->role == 'manager') {
                    if ($role == "manager" || $role == "developer") {
                        $errors = ['oldpass' => ['Pelanggaran']]; 
                        return Redirect::back()->withErrors($errors);
                    }
                    else {
                        DB::table('users')->where('username', $request->data0)->update(
                            [
                                'password' => bcrypt($request->password),
                            ]);
                    }
                }
                elseif ($s1->role == 'admin') {
                    if ($role == "developer" || $role == "manager" || $role == "admin") {
                        $errors = ['oldpass' => ['Pelanggaran']]; 
                        return Redirect::back()->withErrors($errors);
                    }
                    else {
                        DB::table('users')->where('username', $request->data0)->update(
                            [
                                'password' => bcrypt($request->password),
                            ]);
                    }
                }
                else {
                    return redirect('/home');
                }
            }
            

            $errors = ['oldpass' => ['Password Berhasil Dirubah']]; 
            return Redirect::back()->withErrors($errors);
        }

        if(strcmp($request->password, $s1->password) == 1){
            $errors = ['username' => ['Password Salah']]; 
            return Redirect::back()->withErrors($errors);
                }
        else {

        }

    }

    public function planning(){
       $line = DB::table('produk')->select('bagian')->distinct()->get();
       return view('admin.planning', ['line' => $line]);
    }

    public function tambahplan(Request $request){
        DB::table('planning')->insert([
            'bulan' => $request->tanggal,
            'tipe' => $request->tipe,
            'tempat' => $request->tempat,
            'bagian' => $request->bagian,
            'qty' => $request->qty,
        ]);
        return redirect('/user/planning/'.$request->bagian);
    }

    // =====================================
    // ============ P R O D U K ============
    // =====================================

    public function produk() {
        $produk = DB::table('produk')->get();
        $line = $line = DB::table('produk')->select('bagian')->distinct()->get();
        return view('admin.produk', ['data' => $produk, 'bagian' => $line]);
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

    public function produkditambah(Request $request) {
        DB::table('produk')->insert([
            'tipe' => $request->tag3,
            'bagian' => $request->tag1,
            'tempat' => $request->tag2,
            'qtyinner' => $request->tag4,
            'qtyouter' => $request->tag5,

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
        $uni1 = DB::table('defect_loss')->get();
        $uni2 = DB::table('organization_loss')->get();
        $uni3 = DB::table('regulated_loss')->get();
        $uni4 = DB::table('stop_loss')->get();
        $uni5 = DB::table('work_loss')->get();
        $uni6 = DB::table('ability_loss')->get();
        return view('admin.masalah', ['i' => $i, 'data1' => $uni1, 'data2' => $uni2, 'data3' => $uni3, 'data4' => $uni4, 'data5' => $uni5, 'data6' => $uni6, ]);
    }

    public function masalahditambah(Request $request){
        $database = $request->jenis;
            DB::table($database)->insert([
                'loss' => $request->masalah,
            ]);
        return redirect('/pengaturan/masalah');
    }

    public function masalahdirubah(Request $request) {
        $database = $request->paramedit1;
            DB::table($database)->where('id', $request->paramedit0)->update([
                'loss' => $request->paramedit2,
            ]);
        return redirect('/pengaturan/masalah');
    }

    public function masalahdihapus(Request $request){
        DB::table($request->param1)->where('id', $request->param2)->delete();
        return redirect('/pengaturan/masalah');
    }

    // =====================================
    // ============= S H I F T =============
    // =====================================

    public function shift() {
        $index = 1;
        $data = DB::table('waktu')->get();
        return view('admin.shift', ['data' => $data, 'i' =>$index]);
    }

    public function shiftditambah(Request $request) {
        $start = strtotime($request->start);
        $end = strtotime($request->finish);
        $mins = ($end - $start) / 60;
        DB::table('waktu')->insert([
            'shift' => $request->nama,
            'start' => $request->start,
            'finish' => $request->finish,
            'duration' => abs($mins)
        ]);
        return redirect('/pengaturan/shift');
    }

    public function shiftdiedit(Request $request){
        $start = strtotime($request->startedit);
        $end = strtotime($request->finishedit);
        $mins = ($end - $start) / 60;
        DB::table('waktu')->where('id', $request->idedit)->update([
            'shift' => $request->shiftedit,
            'start' => $request->startedit,
            'finish' => $request->finishedit,
            'duration' => abs($mins)
        ]);
        return redirect('/pengaturan/shift');
    }

    public function shiftdihapus(Request $request){
        DB::table('waktu')->where('id', $request->idhapus)->delete();
        return redirect('/pengaturan/shift');
    }

    // =====================================
    // =========== O R A C L E =============
    // =====================================

    public function akunoracle(){
        $data = DB::table('oracle')->where('id', 'utama')->get();
        return view('admin.akunoracle', ['data' => $data]);
    }

    public function oraclesave(Request $request){
        DB::table('oracle')->where('id', 'utama')->update([
            'username' => $request->username,
            'password' => $request->password
        ]);
        return redirect('/admin/akunoracle');
    }
}
