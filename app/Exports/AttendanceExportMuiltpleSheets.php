<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttendanceExportMuiltpleSheets implements WithMultipleSheets
{
    use Exportable;

    protected $data;

    public function __construct(array $dataa)
    {
        $this->data = $dataa;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        // for ($sheet = 1; $sheet <= 4; $sheet++) {

        $sheets[] = new LeaderAttendancesExport($this->data);
        $sheets[] = new GeneralAttendancesExport($this->data);
        $sheets[] = new AuditOneAttendancesExport($this->data);
        $sheets[] = new AuditTwoAttendancesExport($this->data);
        // }

        return $sheets;
    }
}
