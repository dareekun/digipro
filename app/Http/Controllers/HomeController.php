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
        return view('home', [
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
        $user = User::where('username', '=', $s1->username)->first();
        $rules = [
            'password' => ['required', 'string', 'confirmed'],
        ];
        $message = ['password.confirmed' => 'Password Tidak Sama',];
        $this->validate($request, $rules, $message);
        if (Hash::check($request->oldpass, $user->password)) {
            DB::table('users')->where('email', $user->email)->update(
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
    public function select3(Request $request) 
    {
        $htta  = Http::get('http://158.118.35.22:8080/discreet')->getBody();
        $line = DB::table('produk')->select('bagian')->distinct()->get();
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
        $data3 = array();
        for ($i = 0; $i < $total0; $i++) {
                if ($data0[$i]['line'] == $request->get('temt')){
                        array_push($data3, $data0[$i]['assembly_item_name']);
                }
        }
        return response()->json($data3);
    }
    
}
