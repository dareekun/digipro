<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Data extends Component
{

    public $pass;
    public $problem01;
    public $problem02;
    public $problem03;
    public $problem04;
    public $rekap;
    public $result;
    public $option;

    public function mount() {
        $this->problem01['ket'] = '-';
        $this->problem02['ket'] = '-';
        $this->problem03['ket'] = '-';
        $this->problem04['ket'] = '-';
        $this->rekap['ket'] = '-';
        $this->result['hambatan01'] = '-';
        $this->result['analisa01'] = '-';
        $this->result['tindakan01'] = '-';
        $this->result['hambatan02'] = '-';
        $this->result['analisa02'] = '-';
        $this->result['tindakan02'] = '-';
        $this->option = DB::table('dataharian')->where('keyid', $this->pass)->select('bagian')->value('bagian');
    }

    public function delprob($id){
        DB::table('loss_data')->where('idp', $id)->delete();
    }

    public function plus01(){
        $problem01 = $this->validate(
            [
                'problem01.masalah' => 'required',
                'problem01.start' => 'required',
                'problem01.finish' => 'required',
                'problem01.produk' => 'required',
                'problem01.ket' => 'required',
            ],[
                'problem01.masalah.required' => 'Mohon Form Masalah Dipilih',
                'problem01.start.required' => 'Mohon Form Start Diisi',
                'problem01.finish.required' => 'Mohon Form Stop Diisi',
                'problem01.produk.required' => 'Mohon Form Produk Dipilih',
                'problem01.ket.required' => 'Mohon Form Keterangan Diisi',
            ]);
        $start = strtotime($this->problem01['start']);
        $end = strtotime($this->problem01['finish']);
        if (date("H:i:s", $start) > date("H:i:s", strtotime("20:00:00")) && date("H:i:s", $end) < date("H:i:s", strtotime("06:00:00")))
        {
            $mins = ((strtotime("23:59:59") - $start) + 1 + ($end - strtotime("00:00:00")) / 60);
        }else {
            $mins = (($end - $start) / 60);
        }
        DB::table('loss_data') ->insert([
            'keyid' => $this->pass,
            'problem' => $this->problem01['masalah'],
            'start' => $this->problem01['start'],
            'stop' => $this->problem01['finish'],
            'dur' => abs($mins),
            'tipe' => $this->problem01['produk'],
            'ket' => $this->problem01['ket'],
            ]);
            $this->problem01['ket'] = '-';
            $this->problem01['ket'] = '-';
            $this->problem01['ket'] = '-';
            $this->problem01['ket'] = '-';
    }

    public function plus02(){
        $problem02 = $this->validate(
            [
                'problem02.masalah' => 'required',
                'problem02.start' => 'required',
                'problem02.finish' => 'required',
                'problem02.produk' => 'required',
                'problem02.ket' => 'required',
            ],[
                'problem02.masalah.required' => 'Mohon Form Masalah Dipilih',
                'problem02.start.required' => 'Mohon Form Start Diisi',
                'problem02.finish.required' => 'Mohon Form Stop Diisi',
                'problem02.produk.required' => 'Mohon Form Produk Dipilih',
                'problem02.ket.required' => 'Mohon Form Keterangan Diisi',
            ]);
        $start = strtotime($this->problem02['start']);
        $end = strtotime($this->problem02['finish']);
        if (date("H:i:s", $start) > date("H:i:s", strtotime("20:00:00")) && date("H:i:s", $end) < date("H:i:s", strtotime("06:00:00")))
        {
            $mins = ((strtotime("23:59:59") - $start) + 1 + ($end - strtotime("00:00:00")) / 60);
        }else {
            $mins = (($end - $start) / 60);
        }
        DB::table('loss_data') ->insert([
            'keyid' => $this->pass,
            'problem' => $this->problem02['masalah'],
            'start' => $this->problem02['start'],
            'stop' => $this->problem02['finish'],
            'dur' => abs($mins),
            'tipe' => $this->problem02['produk'],
            'ket' => $this->problem02['ket'],
            ]);
            $this->problem02['ket'] = '-';
    }

    public function plus03(){
        $problem03 = $this->validate(
            [
                'problem03.masalah' => 'required',
                'problem03.start' => 'required',
                'problem03.finish' => 'required',
                'problem03.produk' => 'required',
                'problem03.ket' => 'required',
            ],[
                'problem03.masalah.required' => 'Mohon Form Masalah Dipilih',
                'problem03.start.required' => 'Mohon Form Start Diisi',
                'problem03.finish.required' => 'Mohon Form Stop Diisi',
                'problem03.produk.required' => 'Mohon Form Produk Dipilih',
                'problem03.ket.required' => 'Mohon Form Keterangan Diisi',
            ]);
        $start = strtotime($this->problem03['start']);
        $end = strtotime($this->problem03['finish']);
        if (date("H:i:s", $start) > date("H:i:s", strtotime("20:00:00")) && date("H:i:s", $end) < date("H:i:s", strtotime("06:00:00")))
        {
            $mins = ((strtotime("23:59:59") - $start) + 1 + ($end - strtotime("00:00:00")) / 60);
        }else {
            $mins = (($end - $start) / 60);
        }
        DB::table('loss_data') ->insert([
            'keyid' => $this->pass,
            'problem' => $this->problem03['masalah'],
            'start' => $this->problem03['start'],
            'stop' => $this->problem03['finish'],
            'dur' => abs($mins),
            'tipe' => $this->problem03['produk'],
            'ket' => $this->problem03['ket'],
            ]);
            $this->problem03['ket'] = '-';
    }

    public function plus04(){
        $problem04 = $this->validate(
            [
                'problem04.masalah' => 'required',
                'problem04.start' => 'required',
                'problem04.finish' => 'required',
                'problem04.produk' => 'required',
                'problem04.ket' => 'required',
            ],[
                'problem04.masalah.required' => 'Mohon Form Masalah Dipilih',
                'problem04.start.required' => 'Mohon Form Start Diisi',
                'problem04.finish.required' => 'Mohon Form Stop Diisi',
                'problem04.produk.required' => 'Mohon Form Produk Dipilih',
                'problem04.ket.required' => 'Mohon Form Keterangan Diisi',
            ]);
        $start = strtotime($this->problem04['start']);
        $end = strtotime($this->problem04['finish']);
        if (date("H:i:s", $start) > date("H:i:s", strtotime("20:00:00")) && date("H:i:s", $end) < date("H:i:s", strtotime("06:00:00")))
        {
            $mins = ((strtotime("23:59:59") - $start) + 1 + ($end - strtotime("00:00:00")) / 60);
        }else {
            $mins = (($end - $start) / 60);
        }
        DB::table('loss_data') ->insert([
            'keyid' => $this->pass,
            'problem' => $this->problem04['masalah'],
            'start' => $this->problem04['start'],
            'stop' => $this->problem04['finish'],
            'dur' => abs($mins),
            'tipe' => $this->problem04['produk'],
            'ket' => $this->problem04['ket'],
            ]);
            $this->problem04['ket'] = '-';
    }

    public function addproduct(){
        $rekap = $this->validate(
            [
                'rekap.produk' => 'required',
                'rekap.start' => 'required',
                'rekap.stop' => 'required',
                'rekap.plan' => 'required',
                'rekap.actual' => 'required',
                'rekap.process' => 'required',
                'rekap.material' => 'required',
                'rekap.ket' => 'required',
            ],[
                'rekap.produk.required' => 'Mohon Form Tipe Produk Dipilih',
                'rekap.start.required' => 'Mohon Form Waktu Start Diisi',
                'rekap.stop.required' => 'Mohon Form Waktu Stop Diisi',
                'rekap.plan.required' => 'Mohon Form Daily Plan Diisi',
                'rekap.actual.required' => 'Mohon Form Daily Actual Diisi',
                'rekap.process.required' => 'Mohon Form NG Process Diisi',
                'rekap.material.required' => 'Mohon Form NG Material Diisi',
                'rekap.ket.required' => 'Mohon Form Keterangan Diisi',
            ]);
        $a1    = Auth::user();
        $count = DB::table('rekapprod')->where('keyid', $this->pass)->count();
        $start = strtotime($this->rekap['start']);
        $end = strtotime($this->rekap['stop']);
        if (date("H:i:s", $start) > date("H:i:s", strtotime("20:00:00")) && date("H:i:s", $end) < date("H:i:s", strtorime("06:00:00")))
        {
            $mins = ((strtotime("23:59:59") - $start) + 1 + ($end - strtotime("00:00:00")) / 60);
        }else {
            $mins = (($end - $start) / 60);
        }
        $barcode = strtoupper(base_convert($a1->id.date('YmdHis').$count,10,32));
        DB::table('rekapprod')->insert([
            'id' => $barcode,
            'keyid' => $this->pass,
            'tipe' => $this->rekap['produk'],
            'start' => $this->rekap['start'],
            'stop' => $this->rekap['stop'],
            'dur' => abs($mins),
            'daily_plan' => $this->rekap['plan'],
            'daily_actual' => $this->rekap['actual'],
            'daily_diff' => $this->rekap['actual'] - $this->rekap['plan'],
            'ng_process' => $this->rekap['process'],
            'ng_material' => $this->rekap['material'],
            'ng_total' => $this->rekap['material'] + $this->rekap['process'],
            'ket' => $this->rekap['ket'],
            'lastedit' => $a1->username,
            ]);
    }

    public function delproduct($id){
        DB::table('rekapprod')->where('id', $id)->delete();
    }

    public function process(){
        $result = $this->validate(
            [
                'result.hambatan01' => 'required',
                'result.analisa01' => 'required',
                'result.tindakan01' => 'required',
                'result.hambatan02' => 'required',
                'result.analisa02' => 'required',
                'result.tindakan02' => 'required',
                'result.sum' => 'required|gt:0',
                'result.avail' => 'required',
                'result.phh' => 'required',
                'result.ttloss' => 'required',
            ],[
                'result.hambatan01.required' => 'Mohon Form Hambatan Diisi',
                'result.analisa01.required' => 'Mohon Form Analisa Penyebab Diisi',
                'result.tindakan01.required' => 'Mohon Form Tindakan Penanggulangan Diisi',
                'result.hambatan02.required' => 'Mohon Form Produk Diisi',
                'result.analisa02.required' => 'Mohon Form Analisa Penyebab Diisi',
                'result.tindakan02.required' => 'Mohon Form Tindakan Penanggulangan Diisi',
                'result.sum.required' => 'Mohon Form Hasil Produksi Diisi',
                'result.sum.gt' => 'Mohon Rekap Produk Diselesaikan',
                'result.avail.required' => 'Mohon Form Available Working Time Diisi',
                'result.phh.required' => 'Mohon Form Production Head Diisi',
                'result.ttloss.required' => 'Mohon Form Total Loss Time Diisi',
            ]);
        DB::table('resultprod')->insert([
            'keyid' => $this->pass,
            'inti1' => $this->result['hambatan01'],
            'analisa1' => $this->result['analisa01'],
            'tindakan1' => $this->result['tindakan01'],
            'hasil' => $this->result['sum'],
            'avalaible' => $this->result['avail'],
            'phh' => $this->result['phh'],
            'inti2' => $this->result['hambatan02'],
            'analisa2' => $this->result['analisa02'],
            'tindakan2' => $this->result['tindakan02'],
            'ttlloss' => $this->result['ttloss'],
        ]);
        DB::table('dataharian')->where('keyid', $this->pass)->update([
            'autosave' => 'selesai'
        ]);
            return redirect('/data/'.$this->option);
    }

    public function render()
    {
        $s1 = Auth::user();
        $s2 = DB::table('dataharian')->select('bagian')->where('keyid', $this->pass)->distinct()->value('bagian');
        $s4 = DB::table('dataharian')->select('line')->where('keyid', $this->pass)->distinct()->value('line');
        $dreg  = DB::table('loss_type')->where('type', 'Regulated Loss')->select('loss')->get();
        $dwork = DB::table('loss_type')->where('type', 'Work Loss')->select('loss')->get();
        $dorg  = DB::table('loss_type')->where('type', 'Organization Loss')->select('loss')->get();
        $ddef  = DB::table('loss_type')->where('type', 'Defect Loss')->select('loss')->get();
        $data1 = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('loss_type.type', 'Regulated Loss')->where('keyid', $this->pass)->get();
        $data2 = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('loss_type.type', 'Work Loss')->where('keyid', $this->pass)->get();
        $data3 = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('loss_type.type', 'Organization Loss')->where('keyid', $this->pass)->get();
        $data4 = DB::table('loss_data')->leftJoin('loss_type', 'loss_type.loss', '=', 'loss_data.problem')->where('loss_type.type', 'Defect Loss')->where('keyid', $this->pass)->get();
        $produk= DB::table('produk')->where('tempat', $s4)->select('tipe')->get();
        $data5 = DB::table('rekapprod')->where('keyid', $this->pass)
        ->select('id', 'tipe', 'start', 'stop', 'dur', 'daily_plan', 'daily_actual', 'daily_diff', 'ng_process', 'ng_material', 'ket')
        ->distinct()->get();
        
        $this->result['ttloss'] = DB::table('loss_data')->where('keyid', $this->pass)->select('dur')->sum('dur');
        $this->result['sum']    = DB::table('rekapprod')->where('keyid', $this->pass)->select('daily_actual')->sum('daily_actual');
        $this->result['avail']  = DB::table('dataharian')->where('keyid', $this->pass)->select('waktukerja')->value('waktukerja'); 
        $this->result['phh']    = $this->result['sum'] / $this->result['avail'];
        return view('livewire.data', ['data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5,
        'produk' => $produk, 'lossa' => $dreg, 'lossb' => $dwork, 'lossc' => $dorg, 'lossd' => $ddef,]);
    }
}
