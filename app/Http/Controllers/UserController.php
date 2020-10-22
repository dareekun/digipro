<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Validator;

use Illuminate\Support\Facades\Http;
use Nahid\JsonQ\Jsonq;

use App\User;
Use Redirect;
use Auth;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function data($id){
        $s1 = Auth::user();
        $line   = DB::table('produk')->where('bagian', $id)->select('tempat')->distinct()->get();
        $waktu  = DB::table('waktu')->select('shift')->get();
        $stat = DB::table('dataharian')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        $data = DB::table('dataharian')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('keyid')->distinct()->value('keyid');
        return view('user.data', ['bagian' => $id, 'line' => $line, 'waktu' => $waktu, 'status' => $stat, 'data' => $data]);
    }
    public function mesin($id){
        $s1 = Auth::user();
        $line = DB::table('produk')->where('bagian', $id)->select('tempat')->distinct()->get();
        $waktu = DB::table('waktu')->select('shift')->get();
        $stat = DB::table('datamasin')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        $data = DB::table('datamasin')->where('bagian', $id)->where('autosave', 'belum')->where('lastedit', $s1->username)->select('keyid')->distinct()->value('keyid');
        return view('user.mesin1', ['bagian' => $id, 'line' => $line, 'waktu' => $waktu, 'status' => $stat, 'data' => $data]);
    }

    public function mesin2(Request $request) {
        $s0 = DB::table('waktu')->select('start')->where('shift', $request->shift)->value('start');
        $s1 = DB::table('waktu')->select('finish')->where('shift', $request->shift)->value('finish');
        $s2 = DB::table('waktu')->select('duration')->where('shift', $request->shift)->value('duration');
        $s3 = Auth::user();
        $line = explode(" ", $request->bagian);
        $shift = explode(" ", $request->shift);
        $date = date("Ymd", strtotime($request->tanggal));
        $acl = "";
        $acs = "";
        foreach ($line as $w) {
        $acl .= $w[0];
        }
        foreach ($shift as $q) {
            $acs .= $q[0];
            }
        $keyid = $acl.'M'.$request->nomor.$acs.$date;
        $id = DB::table('produk')->select('bagian')->distinct()->where('tempat', $request->line)->value('bagian');
        DB::table('datamasin') ->insert([
            'keyid' => $keyid,
            'tanggal' => $request->tanggal,
            'bagian' => $request->bagian,
            'line'=> $request->nomor,
            'shift' => $request->shift,
            'pic' => $request->pic,
            'part' => $request->tipe,
            'start' => $s0,
            'finish' => $s1,
            'waktukerja' => $s2,
            'lastedit' => $s3->username,
            'autosave' => 'belum',
        ]);
        return redirect('/resumim/'.$keyid);
    }

    public function next(Request $request) {
        $s0 = DB::table('waktu')->select('start')->where('shift', $request->shift)->value('start');
        $s1 = DB::table('waktu')->select('finish')->where('shift', $request->shift)->value('finish');
        $s2 = DB::table('waktu')->select('duration')->where('shift', $request->shift)->value('duration');
        $s3 = Auth::user();
        $line = explode(" ", $request->line);
        $shift = explode(" ", $request->shift);
        $date = date("Ymd", strtotime($request->tanggal));
        $acl = "";
        $acs = "";
        foreach ($line as $w) {
        $acl .= $w[0];
        }
        foreach ($shift as $q) {
            $acs .= $q[0];
            }
        $keyid = $acl.$acs.$date;
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
            'optplan' => $request->jmlop,
            'start' => $s0,
            'finish' => $s1,
            'waktukerja' => $request->wktkrj,
            'lastedit' => $s3->username,
            'autosave' => 'belum',
        ]);
        return redirect('/resume/'.$keyid);

    }

    public function refresh($id) {
        $s1 = DB::table('dataharian')->select('bagian')->where('keyid', $id)->value('bagian');
        DB::table('dataharian')->where('keyid', $id)->delete();
        DB::table('regloss')->where('keyid', $id)->delete();
        DB::table('defloss')->where('keyid', $id)->delete();
        DB::table('orloss')->where('keyid', $id)->delete();
        DB::table('workloss')->where('keyid', $id)->delete();
        return redirect('/data/'.$s1);
    }
    public function refreshing($id) {
        $s1 = DB::table('datamasin')->select('bagian')->where('keyid', $id)->value('bagian');
        DB::table('datamasin')->where('keyid', $id)->delete();
        DB::table('regloss')->where('keyid', $id)->delete();
        DB::table('stoploss')->where('keyid', $id)->delete();
        DB::table('abloss')->where('keyid', $id)->delete();
        DB::table('workloss')->where('keyid', $id)->delete();
        return redirect('/data/'.$s1);
    }

    public function resume($id) {
        $s1 = Auth::user();
        $s2 = DB::table('dataharian')->select('bagian')->where('keyid', $id)->distinct()->value('bagian');
        $s3 = DB::table('dataharian')->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        $s4 = DB::table('dataharian')->select('line')->where('keyid', $id)->distinct()->value('line');
        $s5 = DB::table('rekapprod')->where('keyid', $id)->where('status', 0)->where('lastedit', $s1->username)->count();
        $s6 = DB::table('rekapprod')->select('id')->where('keyid', $id)->where('status', 0)->where('lastedit', $s1->username)->value('id');
        if ($s3 == 'selesai') {
            return redirect('/data/'.$bagian);
        }
        $data = DB::table('dataharian')->where('keyid', $id)->get();
        $dreg = DB::table('regulated_loss')->select('loss')->get();
        $dwork = DB::table('work_loss')->select('loss')->get();
        $dorg = DB::table('organization_loss')->select('loss')->get();
        $ddef = DB::table('defect_loss')->select('loss')->get();
        $waktu = DB::table('waktu')->select('shift')->get();
        $bline = DB::table('produk')->where('bagian', $s2)->select('tempat')->distinct()->get();
        $produk = DB::table('produk')->where('tempat', $s4)->select('tipe')->get();

        $data1 = DB::table('regloss')->where('keyid', $id)->get();
        $data2 = DB::table('workloss')->where('keyid', $id)->get();
        $data3 = DB::table('orloss')->where('keyid', $id)->get();
        $data4 = DB::table('defloss')->where('keyid', $id)->get();
        $data5 = DB::table('lotcard')->join('rekapprod', 'lotcard.keyid', '=', 'rekapprod.id')->where('rekapprod.keyid', $id)
        ->select('rekapprod.id', 'lotcard.modelno', 'rekapprod.start', 'rekapprod.stop', 'rekapprod.dur', 'rekapprod.time', 'rekapprod.plus', 'rekapprod.min', 'rekapprod.man', 'rekapprod.daily', 'rekapprod.ngp', 'rekapprod.ngm', 'rekapprod.fg', 'rekapprod.pt', 'rekapprod.eff', 'lotcard.barcode',)
        ->distinct()->get();
        $data6 = DB::table('resultprod')->where('keyid', $id)->get();
        
        $sum = DB::table('rekapprod')->where('keyid', $id)->select('fg')->sum('fg');
        $lossa = DB::table('regloss')->where('keyid', $id)->select('dur')->sum('dur');
        $lossb = DB::table('workloss')->where('keyid', $id)->select('dur')->sum('dur');
        $lossc = DB::table('orloss')->where('keyid', $id)->select('dur')->sum('dur');
        $lossd = DB::table('defloss')->where('keyid', $id)->select('dur')->sum('dur');
        $totalitas = $lossa + $lossb + $lossc + $lossd;

        $p1 = DB::table('rekapprod')->select('id')->where('keyid', $id)->where('status', 0)->where('lastedit', $s1->username)->value('id');
        return view('user.data2', ['bagian' => $s2, 'data' => $data, 'data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5,
        'summ' => $sum, 'ttloss' => $totalitas, 'tagkey' => $p1,
        'data6' => $data6, 'lot' => $s6, 'jmlh' => $s5, 'bline' => $bline, 'produk' => $produk, 'lossa' => $dreg, 'waktu' => $waktu, 'lossb' => $dwork, 'lossc' => $dorg, 'lossd' => $ddef,]);
    }

    public function resumim($id) {
        $s1 = Auth::user();
        $s2 = DB::table('datamasin')->where('autosave', 'belum')->where('lastedit', $s1->username)->select('bagian')->distinct()->value('bagian');
        $s3 = DB::table('datamasin')->where('autosave', 'belum')->where('lastedit', $s1->username)->select('autosave')->distinct()->value('autosave');
        if ($s1->role=='user' && $s3=='selesai') {
            return redirect('/data/'.$s2);
        }
        else {
            $data = DB::table('datamasin')->where('keyid', $id)->get();
            $dreg = DB::table('regulated_loss')->select('loss')->get();
            $dwork = DB::table('work_loss')->select('loss')->get();
            $dorg = DB::table('organization_loss')->select('loss')->get();
            $ddef = DB::table('defect_loss')->select('loss')->get();
            $waktu = DB::table('waktu')->select('shift')->get();
            $bline = DB::table('produk')->where('bagian', $s2)->select('tempat')->distinct()->get();
            
            $data1 = DB::table('regloss')->where('keyid', $id)->get();
            $data2 = DB::table('stoploss')->where('keyid', $id)->get();
            $data3 = DB::table('abloss')->where('keyid', $id)->get();
            $data4 = DB::table('defloss')->where('keyid', $id)->get();
            $data5 = DB::table('resultmesin')->where('keyid', $id)->get();
        
        return view('user.mesin2', ['bagian' => $s2, 'data' => $data, 'data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5,
        'bline' => $bline, 'lossa' => $dreg, 'waktu' => $waktu, 'lossb' => $dwork, 'lossc' => $dorg, 'lossd' => $ddef,]);
    }
    }

    // ===================================================
    // ================= H A R I A N 2 ===================
    // ===================================================
    
    public function next2(Request $request) {
        $a1  = Auth::user();
        $s2 = DB::table('rekapprod')->where('keyid', $request->subaru)->count();
        $s3 = DB::table('produk')->select('bagian')->distinct()->where('tempat', $request->line)->value('bagian');
        if ($request->has('emilia')) {
            if ($s2==0) {
                $errors = ['oldpass' => ['Kalau Tidak Ada Produksi Tidak Usah Bikin Laporan']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else{
                $st = DB::table('dataharian')->where('keyid', $request->subaru)->select('autosave')->value('autosave');
                if ($st =='belum') {
                DB::table('resultprod') ->insert([
                    'keyid' => $request->subaru,
                    'inti1' => $request->reslt1,
                    'analisa1' => $request->reslt2,
                    'tindakan1' => $request->reslt3,
                    'hasil' => $request->reslt4,
                    'avalaible' => $request->reslt5,
                    'time' => $request->reslt6,
                    'inti2' => $request->reslt1a,
                    'analisa2' => $request->reslt2a,
                    'tindakan2' => $request->reslt3a,
                    'ttlloss' => $request->reslt4a,
                    'ttlman' => $request->reslt5a
                    ]);
                    DB::table('dataharian')->where('keyid', $request->subaru)->update([
                        'autosave' => 'selesai',
                        ]);
                    return redirect('/data/'.$s3);
                }
                else {
                    DB::table('resultprod')->where('keyid', $request->subaru)->update([
                        'inti1' => $request->reslt1,
                        'analisa1' => $request->reslt2,
                        'tindakan1' => $request->reslt3,
                        'hasil' => $request->reslt4,
                        'avalaible' => $request->reslt5,
                        'time' => $request->reslt6,
                        'inti2' => $request->reslt1a,
                        'analisa2' => $request->reslt2a,
                        'tindakan2' => $request->reslt3a,
                        'ttlloss' => $request->reslt4a,
                        'ttlman' => $request->reslt5a
                        ]);
                        $id = DB::table('produk')->select('bagian')->where('tempat', $request->line)->value('bagian');
                        DB::table('dataharian')->where('keyid', $request->subaru)->update([
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
                            'optplan' => $request->optplan,
                            'start' => $request->start,
                            'finish' => $request->finish,
                            'waktukerja' => $request->waktukerja,
                            'lastedit' => $a1->username,
                        ]);
                        return redirect('/data/'.$s3);
                }
            }
        }

        elseif ($request->has('rem1')) {
            DB::table('regloss')->where('id', $request->idd1)->delete();
            return redirect('/resume/'.$request->subaru);
        }
        elseif ($request->has('ram1')) {
            if ($request->regprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Laporan']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                $start = strtotime($request->regstart0);
                $end = strtotime($request->regfinish0);
                $mins = ($end - $start) / 60;
                DB::table('regloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->regprob0,
                    'start' => $request->regstart0,
                    'stop' => $request->regfinish0,
                    'dur' => abs($mins),
                    'tipe' => $request->regprod0,
                    'ket' => $request->regket0,
                    ]);
                    return redirect('/resume/'.$request->subaru);
            }
        }
        elseif ($request->has('rem2')) {
            DB::table('workloss')->where('id', $request->idd2)->delete();
            return redirect('/resume/'.$request->subaru);
        }
        elseif ($request->has('ram2')) {
            if ($request->wrkprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Lapor']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                $start = strtotime($request->wrkstart0);
                $end = strtotime($request->wrkfinish0);
                $mins = ($end - $start) / 60;
                DB::table('workloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->wrkprob0,
                    'start' => $request->wrkstart0,
                    'stop' => $request->wrkfinish0,
                    'dur' => abs($mins),
                    'tipe' => $request->wrkprod0,
                    'ket' => $request->wrkket0,
                    ]);
                    return redirect('/resume/'.$request->subaru);
            }
        }
        elseif ($request->has('rem3')) {
            DB::table('orgloss')->where('id', $request->idd3)->delete();
            return redirect('/resume/'.$request->subaru);
        }
        elseif ($request->has('ram3')) {
            if ($request->orprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Lapor']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                $start = strtotime($request->orstart0);
                $end = strtotime($request->orfinish0);
                $mins = ($end - $start) / 60;
                DB::table('orloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->orprob0,
                    'start' => $request->orstart0,
                    'stop' => $request->orfinish0,
                    'dur' => abs($mins),
                    'tipe' => $request->orprod0,
                    'ket' => $request->orket0,
                    ]);
                    return redirect('/resume/'.$request->subaru);
            }
        }
        elseif ($request->has('rem4')) {
            DB::table('defloss')->where('id', $request->idd4)->delete();
            return redirect('/resume/'.$request->subaru);
        }
        elseif ($request->has('ram4')) {
            if ($request->defprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Lapor']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                $start = strtotime($request->defstart0);
                $end = strtotime($request->deffinish0);
                $mins = ($end - $start) / 60;
                DB::table('defloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->defprob0,
                    'start' => $request->defstart0,
                    'stop' => $request->deffinish0,
                    'dur' => abs($mins),
                    'tipe' => $request->defprod0,
                    'ket' => $request->defket0,
                    ]);
                    return redirect('/resume/'.$request->subaru);
            }
        }
        elseif ($request->has('rem5')) {
            $id1 = DB::table('rekapprod')->select('tipe')->where('id', $request->idd5)->value('tipe');
            DB::table('rekapprod')->where('id', $request->idd5)->delete();
            DB::table('lotcard')->where('keyid', $request->idd5)->where('modelno', $id1)->delete();
            return redirect('/resume/'.$request->subaru);
            
        }
        elseif ($request->has('ram5')) {
            $line = explode(" ", $request->line);
            $shift = explode(" ", $request->shift);
            $date = date("Ymd", strtotime($request->tanggal));
            $char = DB::table('rekapprod')->select('id')->where('keyid', $request->subaru)->orderBy('id', 'desc')->latest('id')->value('id');
            
            if ($char == null) {
                $last = 1;
            }
            else {
                $last = $char[1] + 1;
            }
            $acl = "";
            $acs = "";
            foreach ($line as $w) {
            $acl .= $w[0];
            }
            foreach ($shift as $q) {
                $acs .= $q[0];
            }
            $start = strtotime($request->rekstart0);
            $end = strtotime($request->rekstop0);
            $mins = ($end - $start) / 60;
            $barcode = 'N'.$last.$acl.$acs.$date;
            DB::table('rekapprod')->insert([
                'id' => $barcode,
                'keyid' => $request->subaru,
                'tipe' => $request->rekprod0,
                'start' => $request->rekstart0,
                'stop' => $request->rekstop0,
                'dur' => abs($mins),
                'time' => $request->rektime0,
                'plus' => $request->rekplus0,
                'min' => $request->rekmin0,
                'man' => $request->rekman0,
                'daily' => $request->rekdlyp0,
                'ngp' => $request->rekngp0,
                'ngm' => $request->rekngm0,
                'fg' => $request->rekfg0,
                'pt' => $request->rekpt0,
                'eff' => $request->rekeff0,
                'lastedit' => $a1->username,
                ]);
                    return redirect('/lotsp/'.$barcode);
        }
    }

    public function hapusdataproduk($id){
        $alamat = DB::table('dataharian')->where('keyid', $id)->select('bagian')->value('bagian');
        DB::table('dataharian')->where('keyid', $id)->delete();
        DB::table('regloss')->where('keyid', $id)->delete();
        DB::table('workloss')->where('keyid', $id)->delete();
        DB::table('orloss')->where('keyid', $id)->delete();
        DB::table('defloss')->where('keyid', $id)->delete();
        DB::table('resultprod')->where('keyid', $id)->delete();
        DB::table('rekapprod')->where('keyid', $id)->delete();
        return redirect('/tabel/'.$alamat);
    }

    // ===================================================
    // ================ M E S I N 3 ======================
    // ===================================================
    public function mesin3(Request $request){
        
        if ($request->has('emilia')) {
            $st = DB::table('datamasin')->where('keyid', $request->subaru)->select('autosave')->value('autosave');
                if ($st=='belum') {
                    DB::table('resultmesin')->insert([
                        'keyid' => $request->subaru,
                        'durasi' => $request->reslt1,
                        'cycle' => $request->reslt2,
                        'detail' => $request->reslt3,
                        'hasil' => $request->reslt4,
                        'defect' => $request->reslt5,
                        'waktu' => $request->reslt6,
                        'planning' => $request->reslt7,
                        'eff' => $request->reslt8,
                        'total' => $request->reslt9,
                        ]);
                        DB::table('datamasin')->where('keyid', $request->subaru)->update([
                            'autosave' => 'selesai',
                            ]);
                            return redirect('/data/'.$request->bagian);
                        }
                        else{
                            $a1 = DB::table('waktu')->select('start')->where('shift', $request->shift)->value('start');
                            $a2 = DB::table('waktu')->select('finish')->where('shift', $request->shift)->value('finish');
                            $a3 = DB::table('waktu')->select('duration')->where('shift', $request->shift)->value('duration');
                            $s3 = Auth::user();
                            DB::table('datamasin')->where('keyid', $request->subaru)->update([
                                'tanggal' => $request->tanggal,
                                'bagian' => $request->bagian,
                                'line'=> $request->nomor,
                                'shift' => $request->shift,
                                'pic' => $request->pic,
                                'part' => $request->tipe,
                                'start' => $a1,
                                'finish' => $a2,
                                'waktukerja' => $a3,
                                'lastedit' => $s3->username,
                            ]);
                            DB::table('resultmesin')->where('keyid', $request->subaru)->update([
                                'durasi' => $request->reslt1,
                                'cycle' => $request->reslt2,
                                'detail' => $request->reslt3,
                                'hasil' => $request->reslt4,
                                'defect' => $request->reslt5,
                                'waktu' => $request->reslt6,
                                'planning' => $request->reslt7,
                                'eff' => $request->reslt8,
                                'total' => $request->reslt9,
                                ]);
                                return redirect('/detail/'.$request->subaru);
                        }
        }
        elseif ($request->has('rem1')) {
            DB::table('regloss')->where('id', $request->idd1)->delete();
            return redirect('/resumim/'.$request->subaru);
        }
        elseif ($request->has('ram1')) {
            if ($request->regprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Laporan']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                DB::table('regloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->regprob0,
                    'start' => $request->regstart0,
                    'stop' => $request->regfinish0,
                    'dur' => $request->regdur0,
                    'tipe' => 'mesin',
                    'ket' => $request->regket0,
                    ]);
                    return redirect('/resumim/'.$request->subaru);
            }
        }
        elseif ($request->has('rem2')) {
            DB::table('stoploss')->where('id', $request->idd2)->delete();
            return redirect('/resume/'.$request->subaru);
        }
        elseif ($request->has('ram2')) {
            if ($request->wrkprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Lapor']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                DB::table('stoploss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->wrkprob0,
                    'start' => $request->wrkstart0,
                    'stop' => $request->wrkfinish0,
                    'dur' => $request->wrkdur0,
                    'ket' => $request->wrkket0,
                    ]);
                    return redirect('/resumim/'.$request->subaru);
            }
            
        }
        elseif ($request->has('rem3')) {
            DB::table('abloss')->where('id', $request->idd3)->delete();
            return redirect('/resume/'.$request->subaru);
        }
        elseif ($request->has('ram3')) {
            if ($request->orprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Lapor']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                DB::table('abloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->orprob0,
                    'start' => $request->orstart0,
                    'stop' => $request->orfinish0,
                    'dur' => $request->ordur0,
                    'ket' => $request->orket0,
                    ]);
                    return redirect('/resumim/'.$request->subaru);
            }
        }
        elseif ($request->has('rem4')) {
            DB::table('defloss')->where('id', $request->idd4)->delete();
            return redirect('/resumim/'.$request->subaru);
        }
        elseif ($request->has('ram4')) {
            if ($request->defprob0=='Tidak Ada Masalah') {
                $errors = ['oldpass' => ['Kalau Tidak Ada Masalah Tidak Usah Lapor']]; 
                    return Redirect::back()->withErrors($errors);
            }
            else {
                DB::table('defloss') ->insert([
                    'keyid' => $request->subaru,
                    'problem' => $request->defprob0,
                    'start' => $request->defstart0,
                    'stop' => $request->deffinish0,
                    'dur' => $request->defdur0,
                    'tipe' => 'mesin',
                    'ket' => $request->defket0,
                    ]);
                    return redirect('/resumim/'.$request->subaru);
            }
        }
    }

    public function planning(Request $request){
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
        $filter = array();
        if (isset($request->tag1)) { 
                if (isset($request->tag2)) { 
                    if (isset($request->tag3)) {
                            //  Tag yang di Copy
                            for ($b = 0; $b < $total0; $b++) {
                                if ($data0[$b]['line'] == $request->tag2 && date('Y-m-d', strtotime($data0[$b]['job_start_date'])) == $request->tag3){
                                    array_push($filter, $data0[$b]);
                                }
                                else {
                                }
                            }
                            // batas Copy
                     } else { 
                    //  Tag yang di Copy
                    for ($b = 0; $b < $total0; $b++) {
                        if ($data0[$b]['line'] == $request->tag2){
                            array_push($filter, $data0[$b]);
                        }
                        else {
                        }
                    }
                    // batas Copy
                      }
                 } else { 
                    //  Tag yang di Copy
                    for ($b = 0; $b < $total0; $b++) {
                        if ($data0[$b]['bagian'] == $request->tag1){
                            array_push($filter, $data0[$b]);
                        }
                        else {
                        }
                    }
                    // batas Copy
                  }
            // return json_encode($filter);
            return view('user.planning',['data' => $filter, 'tipe' => $request->tag1, 'bagian' => $line]);
        }else {
            return view('user.planning',['data' => $data0, 'tipe' => '', 'bagian' => $line]);
        }
    }
    
}