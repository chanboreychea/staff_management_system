<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class AttendanceExport implements WithTitle, WithDrawings, WithHeadings, WithCustomStartCell, WithStyles, FromArray
{
    use Exportable;

    protected $data;

    public function __construct(Collection $dataa)
    {
        $this->data = $dataa;
    }

    public function title(): string
    {
        return 'attendances';
    }

    public function styles(Worksheet $sheet)
    {

        // $sheet->getStyle('A7:K7')->applyFromArray(
        //     [
        //         'borders' => [
        //             'outline' => [
        //                 'borderStyle' => Border::BORDER_THICK,
        //                 'color' => [
        //                     'rgb' => '808080'
        //                 ]
        //             ],
        //         ],
        //         'quotePrefix'    => true
        //     ]
        // );
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('audit');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo3.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B2');

        $drawing2 = new Drawing();
        $drawing2->setName('headofcambodian');
        $drawing2->setDescription('This is a second image');
        $drawing2->setPath(public_path('/images/headofcambodian.png'));
        $drawing2->setHeight(50);
        $drawing2->setCoordinates('I2');

        return [
            $drawing,
            $drawing2
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
            [' '], [
                'លរ',
                'ឈ្មោះ',
                'អត្តលេខ',
                'កាលបរិច្ឆេទ',
                'ច្បាប់',
                'ម៉ោងចូល',
                'ចូលយឺត',
                'ម៉ោងចេញ',
                'ចេញយឺត',
                'ម៉ោងធ្វើការ',
                'បេសកកម្ម',
            ],
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
