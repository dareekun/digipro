<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;

class DetailData implements FromView, WithEvents, WithDefaultStyles
{
    private $line;

    public function __construct(String $a)
    {
        $this->line = $a;
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        $record = [];
        $loop = DB::table('product')->leftJoin('production', 'production.model_no', '=', 'product.id')
        ->where('product.line', $this->line)->where('fg_1', '>', 0)->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))
        ->select('product.id as id', 'product.model_no as model_no')->get();
        foreach ($loop  as $lp) {
            $regular = [];
            $regular["model_no"] = $lp->model_no;
            $regular["last_month"] = DB::table('production')->whereYear('date', date('Y'))->whereMonth('date', date("m", strtotime("-1 month")))->where('model_no', $lp->id)->sum("fg_1");
            $array_a = [];
            $sum = 0;
            for ($i = 1; $i < 32 ; $i++ ) {
                $array_b = [];
                $array_b["finish_goods"]  = DB::table('production')->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))->whereDay('date', $i)->where('model_no', $lp->id)->sum('fg_1');
                $array_b["lots_ize"]      = DB::table('production')->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))->whereDay('date', $i)->where('model_no', $lp->id)->count('lotno');
                $sum = $sum + $array_b["finish_goods"];
                $array_b["total_size"]    =  $sum;
                array_push($array_a, $array_b);
            }
            $regular["detail_data"] = $array_a;
            array_push($record, $regular);
        }
        $section = DB::table('product')->where('line', $this->line)->value('section');
        $object = json_decode(json_encode($record));
        return view('dll.export_qc_detail', ['data' => $object, 'line' => $this->line, 'section' => $section]);
    }

    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'font' => [
                'size' => 8,
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->mergeCells('C1:AG1', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
            },
        ];
    }
}