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
    
    public function daftar(Request $request) {
        $s1 = Auth::user();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ];
        $message = [
            'password.confirmed' => 'Password Tidak Sama',
            'username.unique' => 'Username sudah diambil',
        ];
        $this->validate($request, $rules, $message);
        if ($s1->role == 'developer' || $s1->role == 'manager' ) {
            $role = $request->role;
        }
        else {
            $role = 'user';
        }
        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $role,
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
            $data = DB::table('users')->where('role', '<>', 'developer')->where('role', '<>', 'manager')->get();
        }
        else {
            $data = DB::table('users')->where('role', '<>', 'developer')->where('role', '<>', 'manager')->where('role', '<>', 'admin')->get();
        }
        return view('auth.pengaturan', ['data' => $data, 'i' => 1]);
    }

    public function delaku(Request $request) {
        $s1 = Auth::user();
        $data = DB::table('users')->where('username', $request->data0)->get();
        $role = DB::table('users')->select('role')->where('username', $request->data0)->value('role');
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
            'qtyinner' => $request->edittag4,
            'qtyouter' => $request->edittag5,
            'time' => $request->edittag6
        ]);
        return redirect('/admin/produk');
    }

    public function produkditambah(Request $request) {
        DB::table('produk')->insert([
            'tipe' => $request->tag3,
            'bagian' => $request->tag1,
            'tempat' => $request->tag2,
            'qtyinner' => $request->tag4,
            'qtyouter' => $request->tag5,
            'time' => $request->tag6
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
            ]);
        return redirect('/pengaturan/masalah');
    }

    public function masalahdirubah(Request $request) {
            DB::table('loss_type')->where('id', $request->paramedit0)->update([
                'type' => $request->paramedit1,
                'loss' => $request->paramedit2,
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
