<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class AttendanceExport implements WithDrawings, FromArray, WithHeadings, WithCustomStartCell, WithStyles
{
    use Exportable;

    protected $data;

    public function __construct(Collection $dataa)
    {
        $this->data = $dataa;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'E6'    => ['font' => ['bold' => true, 'Fasthand' => true]],

            // Styling a specific cell by coordinate.
            'B' => ['font' => ['Fasthand' => true]],

        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo3.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B2');

        // $drawing2 = new Drawing();
        // $drawing2->setName('Other image');
        // $drawing2->setDescription('This is a second image');
        // $drawing2->setPath(public_path('/images/logo3.png'));
        // $drawing2->setHeight(120);
        // $drawing2->setCoordinates('D1');

        return [
            $drawing,
            // $drawing2
        ];
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function headings(): array
    {
        return [
            [' ', ' ', ' ', ' ', 'បញ្ជីស្រង់វត្តមានមន្ត្រីនៃអង្គភាព អសហ'],
            [' '],
            [
                'No',
                'User Name',
                'User ID',
                'Date',
                'Leave',
                'Check In',
                'Late In',
                'Check Out',
                'Late Out',
                'Actual Work',
                'Mission',
            ]
        ];
    }

    public function array(): array
    {
        $attendances = [];
        foreach ($this->data as $key => $item) {

            $attendances[] = [
                $key + 1,
                $item->lastNameKh . ' ' . $item->firstNameKh,
                $item->userId,
                $item->date,
                '',
                $item->checkIn,
                '',
                $item->checkOut,
                '',
                $item->total,
                ''
            ];
        }
        return $attendances;
    }
}
