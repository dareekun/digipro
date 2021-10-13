<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class InputResultSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
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
        $data = DB::table('rekap_prod')->join('dataharian', 'rekap_prod.keyid', '=', 'dataharian.keyid')->join('waktu', 'dataharian.shift', '=', 'waktu.value')->join('produk', 'rekap_prod.tipe', '=', 'produk.tipe')
        ->select('dataharian.tanggal as tanggal', 'waktu.value as shift', 'dataharian.line as Line_Produksi', 'rekap_prod.tipe as ItemCode', 'rekap_prod.daily_actual as Qty', 'rekap_prod.ng_total as Defect', 'produk.time as Standar_Time')->distinct()
        ->whereMonth('dataharian.tanggal', $this->month)->whereYear('dataharian.tanggal', $this->year)->where('dataharian.autosave', 'selesai')
        ->orderBy('dataharian.tanggal', 'asc')->orderBy('waktu.value', 'asc')->orderBy('rekap_prod.tipe', 'asc')
        ->get();
        return $data;
    }
    
    public function headings(): array
    {
        return [
            'Date', 'Shift', 'Line Prod.', 'Item Code', 'Qty', 'NG', 'Standard Time'
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Input Result ' . $this->month. ' - '. $this->year;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}