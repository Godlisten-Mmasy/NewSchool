<?php

namespace App\Exports;

use App\Models\Attendances;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendancesExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'student_id',
            'Firstname',
            'Surname',
            'attendance_status',
            'Parent Phone'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return AppModelsAttendances::all();
        return collect(Attendances::getAttendances());
    }
}
