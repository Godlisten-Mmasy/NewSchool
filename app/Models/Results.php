<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Results extends Model
{
    use HasFactory;
    protected $fillable = [
        'result_id',
        'student_id',
        'class_id',
        'subject_id',
        'score',
        'result_status',
    ];

    protected $table = "results";

    public static function getResults(){
        $record = DB::table('results')
        ->join('students','students.student_id','=','results.student_id')
        ->join('subjects','subjects.subject_id','=','results.subject_id')
        ->select('results.student_id','fname','tname','subjects.name','score','Phone')
        ->get()->toArray();
        return $record;
    }
}
