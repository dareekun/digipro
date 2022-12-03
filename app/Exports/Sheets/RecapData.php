<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class RecapData implements FromView, WithEvents, ShouldAutoSize
{

    private $map = array();
    private $starter = 6;
    private $last = 0;

    public function __construct()
    {
        $this->thick_outline = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $this->thin_allboarders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        $this->map = DB::table('product')->leftJoin('production', 'production.model_no', '=', 'product.id')
        ->where('fg_1', '>', 0)->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))
        ->select(DB::raw('count(distinct(product.model_no)) as total_model'), 'product.line')->groupBy('product.line')->orderBy('product.line', 'desc')->get();
        $object = DB::table('product')->leftJoin('production', 'production.model_no', '=', 'product.id')
        ->where('fg_1', '>', 0)->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))
        ->select('product.line as line', 'product.model_no as model_no', DB::raw('count(production.lotno) as total_lot'), DB::raw('SUM(production.fg_1) as total_qty'))
        ->groupBy('product.model_no', 'product.line')->orderBy('product.line', 'desc')->get();
        $grand_lot = DB::table('product')->leftJoin('production', 'production.model_no', '=', 'product.id')
        ->where('fg_1', '<>', NULL)->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))->count('lotno');
        $grand_qty = DB::table('product')->leftJoin('production', 'production.model_no', '=', 'product.id')
        ->where('fg_1', '<>', NULL)->whereYear('production.date', date('Y'))->whereMonth('production.date', date("m"))->sum('fg_1');
        return view('dll.export_qc_recap', ['data' => $object, 'tanggal' => date('M / Y'), 'grand_total_lot' => $grand_lot, 'grand_total_qty' => $grand_qty]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:N1', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->mergeCells('H3:I3', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->getStyle('H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getFont()->setSize(20);
                $event->sheet->getRowDimension(2)->setRowHeight(2);
                $event->sheet->getRowDimension(5)->setRowHeight(2);

                foreach ($this->map as $mp) {
                    $this->last = $this->starter + $mp->total_model - 1;
                    $event->sheet->mergeCells('A'.$this->starter.':A'.$this->last, \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_EMPTY);
                    $event->sheet->getStyle('A'.$this->starter)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $this->starter = $this->last + 1;
                }

                $event->sheet->mergeCells('C'.($this->last+5).':E'.($this->last+6), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_EMPTY);
                $event->sheet->getStyle('C'.($this->last+5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->mergeCells('G'.($this->last+5).':J'.($this->last+6), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_EMPTY);
                $event->sheet->getStyle('G'.($this->last+5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->mergeCells('K'.($this->last+5).':N'.($this->last+6), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_EMPTY);
                $event->sheet->getStyle('K'.($this->last+5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:N'.($this->last+3))->applyFromArray($this->thin_allboarders);
                $event->sheet->getStyle('A1:N'.($this->last+3))->applyFromArray($this->thick_outline);
                $event->sheet->getRowDimension($this->last+1)->setRowHeight(2);
                $event->sheet->getRowDimension($this->last+3)->setRowHeight(2);
                $event->sheet->getStyle('A'.($this->last+5).':N'.($this->last+15))->applyFromArray($this->thin_allboarders);
                $event->sheet->getStyle('A'.($this->last+5).':N'.($this->last+6))->applyFromArray($this->thick_outline);
            },
        ];
    }
}