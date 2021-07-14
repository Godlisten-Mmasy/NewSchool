<?php
namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withStartRow;
use App\Models\Students;
use App\Http\Controllers\Controller;



class ImportStudents extends Controller  implements ToModel
{

    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Students([
            'student_id' => $row[0],
            'fname'      => $row[1],
            'sname'      => $row[2],
            'tname'      => $row[3],
            'class'      => $row[4],
            'phone'      => $row[5]
         ]);

    }
}
