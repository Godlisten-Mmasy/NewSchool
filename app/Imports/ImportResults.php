<?php
namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withStartRow;
use App\Models\Results;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class ImportResults extends Controller  implements ToModel
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
        if(!is_numeric($row[3])){
            $row[3]=0;
        }
        

        if($row[1]!='class_id'){
        $classes = DB::table('classes')
        ->where('name',strtoupper($row[1]))
        ->get();
        foreach ($classes as $class) {
            $row[1] = $class->class_id;
        }
        }
        if($row[2]!='subject_id'){
            $subjects = DB::table('subjects')
            ->where('name',strtoupper($row[2]))
            ->get();
            foreach ($subjects as $subject) {
                $row[2] = $subject->subject_id;
            }
        }

        
        $results = DB::table('results')
        ->where('student_id',$row[0])
        ->where('class_id',$row[1])
        ->where('subject_id',$row[2])
        ->get();

        if(count($results)>0){
            $results = results::
            where('class_id','=',$row[1])
            ->where('subject_id','=',$row[2])
            ->where('student_id','=',$row[0])->first();
            $results->score = $row[3];
            $results->result_status = '';
            $results->save();
        }else{
        if($row[0]!='student_id'&&$row[1]!='class_id'){
        return new Results([
            'result_id' => uniqid(),
            'student_id' => $row[0],
            'class_id'      => $row[1],
            'subject_id'      => $row[2],
            'score'      => $row[3],
            'result_status'      => ''
         ]);
        }
        }

    }
}
