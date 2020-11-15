<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CustomerExport implements FromArray,
                WithHeadings,
                WithMapping,
                WithCustomStartCell,
                WithEvents,
                WithColumnFormatting,
                WithColumnWidths
{
    use Exportable;

    protected $dataExport;

    public function __construct($dataExport)
    {
        $this->dataExport = $dataExport;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Tên sản phẩm',
            'Đơn vị',
            'Số lượng',
            'Giá',
            'Thành Tiền'
        ];
    }

    public function array(): array
    {
        return $this->dataExport;
    }

    public function startCell(): string
    {
        return 'A10';
    }

    public function map($dataExport): array
    {
        return [
            $dataExport['id'],
            $dataExport['product_name'],
            $dataExport['product_unit'],
            $dataExport['product_amount'],
            $dataExport['product_price'],
            $dataExport['sum_price'],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->mergeCells('B3:E3')->getStyle('B3:E3')->getAlignment()->setHorizontal('center');
                $event->sheet->getCell('B3')->setValue('HÓA ĐƠN');
                $event->sheet->mergeCells('A5:B5')->getStyle('A5:B5')->getAlignment()->setHorizontal('center');
                $event->sheet->getCell('A5')->setValue('Tên khách hàng:'.$this->dataExport[0]['customer_name']);
                $currentRow = $event->sheet->getHighestRow();
                $sRow = $currentRow+2;
                $bRow = $currentRow+5;
                $dRow = $currentRow+4;
                $bFooter = 'A'.($bRow).':C'.($bRow);
                $cFooter = 'D'.($bRow).':F'.($bRow);
                $dateFooter =  'D'.($dRow).':F'.($dRow);
                $event->sheet->getCell('B'.($sRow))->setValue('Tổng tiền');
                $event->sheet->getCell('F'.($sRow))->setValue($this->totalAmount());
                $event->sheet->getStyle('F'.($sRow))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $event->sheet->getStyle($bFooter)->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle($cFooter)->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle($dateFooter)->getAlignment()->setHorizontal('center');
                $event->sheet->mergeCells($bFooter);
                $event->sheet->getCell('A'.($bRow))->setValue('Người Mua');
                $event->sheet->mergeCells($dateFooter);
                $event->sheet->getCell('D'.($dRow))->setValue('Ngày .... Tháng...... Năm.......');
                $event->sheet->mergeCells($cFooter);
                $event->sheet->getCell('D'.($bRow))->setValue('Người Bán');
            },
        ];
    }

    public function totalAmount(){
        $sumPrice = collect($this->dataExport)->pluck('sum_price')->toArray();
        return array_sum($sumPrice);
    }
}
