<?php

namespace App\Exports;

use App\Models\Results;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'student_id',
            'Firstname',
            'Surname',
            'Subject',
            'Score',
            'Parent Phone'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return AppModelsResults::all();
        return collect(Results::getResults());
    }
}
