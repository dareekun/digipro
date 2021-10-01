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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile($id){
        $user = Auth::user();
        if ($id != $user->username) {
            return redirect('/profile/'.$user->username);
        }
        else {
            $data = DB::table('users')->where('username', $id)->get();
            $user = DB::table('users')->select('username')->where('username', $id)->value('username');
            return view('user.profile', ['data' => $data, 'user' => $user]);
        }
    }
    public function profileupdate(Request $request) {
        $s1 = Auth::user();
        $user = Auth::user()->where('username', '=', $s1->username)->first();
        $rules = [
            'password' => ['required', 'string', 'confirmed'],
        ];
        $message = ['password.confirmed' => 'Password Tidak Sama',];
        $this->validate($request, $rules, $message);
        if (Hash::check($request->oldpass, $user->password)) {
            DB::table('users')->where('username', $user->username)->update(
                [
                    'password' => bcrypt($request->password),
                ]
            );
            $errors = ['oldpass' => ['Password Berhasil Dirubah']]; 
            return Redirect::back()->withErrors($errors);
        }
        else {
            $errors = ['oldpass' => ['Password Salah']]; 
            return Redirect::back()->withErrors($errors);
        }
        if(strcmp($request->oldpass, $user->password) == 0){
            $errors = ['username' => ['Password tidak boleh sama dengan password saat ini']]; 
            return Redirect::back()->withErrors($errors);
                }
        else {
        }
    }
    public function select1(Request $request)
    {
        $data1 = DB::table('produk')->where('bagian', $request->get('bag'))->orderBy('tempat', 'asc')->distinct()->pluck('tempat');
        return response()->json($data1);
    }
    public function select2(Request $request)
    {
        $data2 = DB::table('produk')->where('tempat', $request->get('temt'))->pluck('tipe');
        return response()->json($data2);
    }
}
