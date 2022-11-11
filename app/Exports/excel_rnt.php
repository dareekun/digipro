<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;

class excel_rnt implements FromView, WithEvents
{
    
    public function __construct($id)
    {
        $this->refer = $id;
        $this->thick_outline = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $this->thick_allboarders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $this->medium_allboarders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
    }

    public function view(): View
    {
        $transl = DB::table('transfers')->where('refer', $this->refer)->value('transfers_date');
        $record = DB::table('transaction')->leftJoin('production', 'production.id', '=', 'transaction.productionId')
        ->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
        ->select('product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'product.packing as packing', 'production.fg_2 as total_box', 'production.fg_1 as total_qty', 'quality.remark as remark')
        ->where('transaction.referTransfers', $this->refer)->get();
        return view('dll.excel_rnt', ['data' => $record, 'tanggal' => $transl, 'i' => 1]);
    }
    
    public function registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // Judul Excel
                $event->sheet->mergeCells('C2:I2', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->mergeCells('B46:I46', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->mergeCells('C47:I47', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->mergeCells('C48:I48', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->mergeCells('C49:I49', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->mergeCells('C50:I50', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->mergeCells('C53:I53', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE); 
                $event->sheet->getStyle('C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C53')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Tanda Tangan 
                $event->sheet->mergeCells('F4:G4', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('F5:F9', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('G5:G9', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('H4:I4', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('I5:I9', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->mergeCells('H5:H9', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::MERGE_CELL_CONTENT_MERGE);
                $event->sheet->getStyle('F4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('H4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Border Setting
                $event->sheet->getStyle('A1:J51')->applyFromArray($this->thick_outline);
                $event->sheet->getStyle('F4:I10')->applyFromArray($this->thick_allboarders);
                $event->sheet->getStyle('B12:I45')->applyFromArray($this->medium_allboarders);

                // Set Font Style 
                $event->sheet->getStyle('C2')->getFont()->setBold(true);
                $event->sheet->getStyle('B46')->getFont()->setBold(true);
                $event->sheet->getStyle('C7')->getFont()->setBold(true);
                $event->sheet->getStyle('B46')->getFont()->setSize(14);
                $event->sheet->getStyle('C2')->getFont()->setSize(18);
                $event->sheet->getStyle('C7')->getFont()->setSize(13);

                // Width Column
                $event->sheet->getColumnDimension('A')->setWidth(1);
                $event->sheet->getColumnDimension('B')->setWidth(4);
                $event->sheet->getColumnDimension('C')->setWidth(30);
                $event->sheet->getColumnDimension('D')->setWidth(10);
                $event->sheet->getColumnDimension('E')->setWidth(6);
                $event->sheet->getColumnDimension('F')->setWidth(16);
                $event->sheet->getColumnDimension('G')->setWidth(16);
                $event->sheet->getColumnDimension('H')->setWidth(16);
                $event->sheet->getColumnDimension('I')->setWidth(16);
                $event->sheet->getColumnDimension('J')->setWidth(1);
            },
        ];
    }
}
