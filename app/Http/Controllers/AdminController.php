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
    
    // =====================================
    // ============= U S E R S =============
    // =====================================
    

    public function users_control () {
        $data = DB::table('users')->leftJoin('department_list', 'users.department', '=', 'department_list.id')
        ->select('users.id as id', 'users.name as name', 'users.username as username', 'department_list.department as department', 'users.role as role', 'users.email as email')
        ->where('users.department', '<>', 999)->get();
        return view('control.users_control', ['users' => $data]);
    }

    public function add_users(Request $request) {
        if (DB::table('users')->where('username', $request->nik_add)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'User NIK Already Exists']);
        } else {
            DB::table('users')->insert([
                'name' => $request->name_add,
                'username' => $request->nik_add,
                'department' => $request->department_add,
                'role' => $request->role_add,
                'email' => $request->email_add,
                'password' => bcrypt($request->password_add),
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Users Successfully Added']);
        } 
    }

    public function del_users(Request $request){
        DB::table('users')->where('id', $request->uid_delete)->delete();
        return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Users Successfully Added']);
    }

    public function edt_users(Request $request){
        if (DB::table('users')->where('id', '<>', $request->uid_edit)->where('username', $request->nik_edit)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Duplicate Data Users']);
        } else {
            DB::table('users')->where('id', $request->uid_edit)->update([
                'name' => $request->model_edit,
                'department' => $request->section_edit,
                'role' => $request->line_edit,
                'email' => $request->packing_edit,
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Users Successfully Update']);
        }
    }

    public function upd_users(Request $request){
        if ($request->password1 != $request->password2) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Password Missmatch']);
        } else {
            $nik = DB::table('users')->where('id', $request->password_id)->value('username');
            DB::table('users')->where('id', $request->uid_edit)->update([
                'password' => bcrypt($request->password1),
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Password User '. $nik .' Successfully Update']);
        }
    }

    // =====================================
    // =====+== D E P A R T M E N T ========
    // =====================================
    
    public function department_control () {
        $data = DB::table('department_list')->get();
        return view('control.department_control');
    }

    public function add_department(Request $request) {
        if (DB::table('product')->where('model_no', $request->model_add)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Department Already Exists']);
        } else {
            DB::table('product')->insert([
                'model_no' => $request->model_add,
                'section' => $request->section_add,
                'line' => $request->line_add,
                'packing' => $request->packing_add,
                'time' => $request->time_add,
                'std_mp' => $request->man_add,
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Department Successfully Added']);
        } 
    }

    public function del_department(Request $request){
        DB::table('product')->where('id', $request->value_uid_delete)->delete();
        return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Product Successfully Added']);
    }

    public function edt_department(Request $request){
        if (DB::table('product')->where('id', '<>', $request->value_uid_edit)->where('model_no', $request->model_edit)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Duplicate Data Department']);
        } else {
            DB::table('product')->where('id', $request->value_uid_edit)->update([
                'model_no' => $request->model_edit,
                'section' => $request->section_edit,
                'line' => $request->line_edit,
                'packing' => $request->packing_edit,
                'time' => $request->time_edit,
                'std_mp' => $request->man_edit,
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Department Successfully Update']);
        }
    }
    
    
    // =====================================
    // ============ P R O D U K ============
    // =====================================


    public function product_control () {
        $data = DB::table('product')->get();
        return view('control.product_control', ['products' => $data, 'i' => 1]);
    }

    public function detail_product($id) {
        return view('control.detail_product', ['refere' => $id]);
    }   

    public function add_product(Request $request) {
        if (DB::table('product')->where('model_no', $request->model_add)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Product Already Exists']);
        } else {
            DB::table('product')->insert([
                'model_no' => $request->model_add,
                'section' => $request->section_add,
                'line' => $request->line_add,
                'packing' => $request->packing_add,
                'time' => $request->time_add,
                'std_mp' => $request->man_add,
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Product Successfully Added']);
        } 
    }

    public function del_product(Request $request){
        DB::table('product')->where('id', $request->value_uid_delete)->delete();
        return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Product Successfully Added']);
    }

    public function edt_product(Request $request){
        if (DB::table('product')->where('id', '<>', $request->value_uid_edit)->where('model_no', $request->model_edit)->exists()) {
            return back()->with('alerts', ['type' => 'alert-danger', 'message' => 'Duplicate Data Product']);
        } else {
            DB::table('product')->where('id', $request->value_uid_edit)->update([
                'model_no' => $request->model_edit,
                'section' => $request->section_edit,
                'line' => $request->line_edit,
                'packing' => $request->packing_edit,
                'time' => $request->time_edit,
                'std_mp' => $request->man_edit,
            ]);
            return back()->with('alerts', ['type' => 'alert-success', 'message' => 'Data Product Successfully Update']);
        }
    }

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
