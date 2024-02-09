<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class LeaderAttendancesExport implements WithTitle, WithDrawings, WithHeadings, WithCustomStartCell, WithStyles, FromArray
{
    use Exportable;

    protected $data;

    public function __construct(Collection $dataa)
    {
        $this->data = $dataa;
    }

    public function title(): string
    {
        return 'ថ្នាក់ដឹកនាំ';
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
            [' ', ' ', ' ', 'បញ្ជីស្រង់វត្តមានថ្នាក់ដឹកនាំនៃអង្គភាពសវនកម្មផ្ទៃក្នុង អ.ស.ហ'],
            [' '], [
                'លរ',
                'ឈ្មោះ',
                'ភេទ', 'ថ្ងៃខែឆ្នាំកំណើត', 'តួនាទី', 'លេខទូរស័ព្ទ', 'ចំនួនថ្ងៃមកធ្វើការ', 'វត្តមាន មានច្បាប់', 'វត្តមាន​ ឥតច្បាប់', 'បេសកកម្ម'
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

            if ($item->roleNameKh == 'ប្រធានអង្គភាព' || $item->roleNameKh == 'អនុប្រធានអង្គភាព') {

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
