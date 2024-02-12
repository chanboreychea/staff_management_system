<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class AuditOneAttendancesExport implements WithTitle, WithDrawings, WithHeadings, WithCustomStartCell, WithStyles, FromArray
{
    use Exportable;

    protected $data;

    public function __construct(Collection $dataa)
    {
        $this->data = $dataa;
    }

    public function title(): string
    {
        return 'នាយកដ្ឋានសវនកម្មទី១';
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '0000ff'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '0000ff'],
                ],
            ],

        ];

        $sheet->getTabColor()->setRGB('0000ff');
        $sheet->getStyle('A7:L7')->getFont()->getColor()->setARGB('FFFFFF');
        $sheet->getStyle("A7:L7")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
        $sheet->getStyle("A1:L6")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFA500');
        for ($i = 0; $i <= count($this->array()) + 1; $i++) {
            $row = $i + 7;
            $sheet->getStyle("A$row:L$row")->getFont()->setSize(10);
            $sheet->getStyle("A$row:L$row")->applyFromArray($styleArray);
        }
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo3.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B2');

        $drawing2 = new Drawing();
        $drawing2->setName('Other image');
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
            [' ', ' ', ' ', ' ', 'បញ្ជីស្រង់វត្តមានមន្ត្រីនៃនាយកដ្ឋាន សវន​​កម្មទី​ ១'],
            [' '], [
                'លរ',
                'ឈ្មោះ',
                'ភេទ', 'ថ្ងៃខែឆ្នាំកំណើត', 'តួនាទី', 'លេខទូរស័ព្ទ', 'ចំនួនថ្ងៃមកធ្វើការ', 'វត្តមាន មានច្បាប់', 'វត្តមាន​ ឥតច្បាប់', 'ចូលយឺត', 'ចេញយឺត', 'បេសកកម្ម'
            ],
            [
                'No',
                'Name',
                'Sex',
                'Date Of Birth',
                'Position',
                'Contact',
                'Work Day',
                'Absent (allow)',
                'Absent (not allow)',
                'Late In',
                'Late Out',
                'Mission',
            ]
        ];
    }

    public function array(): array
    {
        $attendances = [];
        $no = 1;
        foreach ($this->data as $key => $item) {

            if ($item->gender == 'm') {
                $gender = 'ប្រុស';
            } else {
                $gender = 'ស្រី';
            }

            if ($item->departmentNameKh == "សវនកម្មទី១") {
                $attendances[] = [
                    $no++,
                    $item->lastNameKh . ' ' . $item->firstNameKh,
                    $gender,
                    $item->dateOfBirth,
                    $item->roleNameKh,
                    $item->phoneNumber,
                    $item->total,
                    $item->leave,
                    '',
                    $item->lateIn,
                    $item->lateOut,
                    $item->mission
                ];
            }
        }
        return $attendances;
    }
}
