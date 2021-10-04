<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class InputTimeSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        $loss1 = DB::table('loss_type')->where('type', 'Regulated Loss')->select('loss')->orderBy('id', 'asc')->get();
        $loss2 = DB::table('loss_type')->where('type', 'Defect Loss')->select('loss')->orderBy('id', 'asc')->get();
        $loss3 = DB::table('loss_type')->where('type', 'Organization Loss')->select('loss')->orderBy('id', 'asc')->get();
        $loss4 = DB::table('loss_type')->where('type', 'Work Loss')->select('loss')->orderBy('id', 'asc')->get();
        $basis = DB::table('dataharian')->join('waktu', 'dataharian.shift', '=', 'waktu.shift')
        ->select('dataharian.keyid as keyid', 'dataharian.tanggal as date', 'waktu.value as shift', 'dataharian.line as lineprod', 
        'dataharian.kwt as kwt', 'dataharian.kartap as kt', 'dataharian.waktukartap as wtkt', 'dataharian.waktukwt as wtkwt',
        'dataharian.otkartap as otkt', 'dataharian.otkwt as otkwt', 'dataharian.absenkartap as absnkt', 'dataharian.absenkwt as absnkwt', 
        'dataharian.bantuan_masuk_waktu as bmw', 'dataharian.bantuan_keluar_waktu as bkw')
        ->whereMonth('tanggal', $this->month)->whereYear('tanggal', $this->year)->where('autosave', 'selesai')
        ->get();
        $array3 = [];
        foreach ($basis as $bs) {
            $array1[] = $bs->date;
            $array1[] = $bs->shift;
            $array1[] = $bs->lineprod;
            $array1[] = $bs->wtkt;
            $array1[] = $bs->otkt + $bs->otkwt;
            $array1[] = $bs->kt;
            $array1[] = $bs->kwt;
            $array1[] = $bs->absnkt + $bs->absnkwt;
            $array1[] = $bs->otkt + $bs->otkwt;
            $array1[] = $bs->bmw - $bs->bkw;
            $array1[] = $bs->wtkt * ($bs->kt + $bs->kwt);
            $array1[] = $bs->otkt + $bs->otkwt;
            $array1[] = ($bs->wtkt * ($bs->kt + $bs->kwt)) + ($bs->otkt + $bs->otkwt) + ($bs->bmw - $bs->bkw);
            foreach ($loss1 as $lc1) {
                $value = DB::table('loss_data')->where('keyid', $bs->keyid)->where('problem', $lc1->loss)->select('dur')->sum('dur');
                $array1[] = $value;
                $array2[] = $value;
            }
            foreach ($loss2 as $lc2) {
                $value = DB::table('loss_data')->where('keyid', $bs->keyid)->where('problem', $lc2->loss)->select('dur')->sum('dur');
                $array1[] = $value;
                $array2[] = $value;
            }
            foreach ($loss3 as $lc3) {
                $value = DB::table('loss_data')->where('keyid', $bs->keyid)->where('problem', $lc3->loss)->select('dur')->sum('dur');
                $array1[] = $value;
                $array2[] = $value;
            }
            foreach ($loss4 as $lc4) {
                $value = DB::table('loss_data')->where('keyid', $bs->keyid)->where('problem', $lc4->loss)->select('dur')->sum('dur');
                $array1[] = $value;
                $array2[] = $value;
            }
            $array1[] = array_sum($array2);
            $array1[] = DB::table('resultprod')->where('keyid', $bs->keyid)->select('inti1')->value('inti1');
            $array3[] = $array1;
            $array1 = [];
            $array2 = [];
        } 
        $collection = collect([$array3]);
        return $collection;
    }
    
    public function headings(): array
    {
        $header = ['Date', 
        'Shift', 
        'Line Prod.', 
        'Working Time', 
        'Overtime', 
        'KT', 
        'KWT',
        'Absence',
        'Overtime Worker',
        'In / Out Support',
        'Available Working Time',
        'Overtime Working Time',
        'Total Working Time',];
        $loss1 = DB::table('loss_type')->where('type', 'Regulated Loss')->select('loss')->orderBy('id', 'asc')->get();
        $loss2 = DB::table('loss_type')->where('type', 'Defect Loss')->select('loss')->orderBy('id', 'asc')->get();
        $loss3 = DB::table('loss_type')->where('type', 'Organization Loss')->select('loss')->orderBy('id', 'asc')->get();
        $loss4 = DB::table('loss_type')->where('type', 'Work Loss')->select('loss')->orderBy('id', 'asc')->get();
        foreach ($loss1 as $ls1) {
            array_push($header, $ls1->loss);
        }
        foreach ($loss2 as $ls2) {
            array_push($header, $ls2->loss);
        }
        foreach ($loss3 as $ls3) {
            array_push($header, $ls3->loss);
        }
        foreach ($loss4 as $ls4) {
            array_push($header, $ls4->loss);
        }
        array_push($header, 'Total Loss');
        array_push($header, 'Remark');
        return $header;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Input Time ' . $this->month. ' - '. $this->year;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}