<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendances extends Model
{
    use HasFactory;

    protected $table = "attendances";

    public static function getAttendances(){
        $record = DB::table('attendances')
        ->join('students','students.student_id','=','attendances.student_id')
        ->select('attendances.student_id','fname','tname','attendance_status','Phone')
        ->where('attendance_date',$_REQUEST['attendance_date'])
        ->get()->toArray();
        return $record;
    }
}
