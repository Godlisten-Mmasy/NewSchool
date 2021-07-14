<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Students;
use App\Models\Attendances;
use App\Exports\AttendancesExport;
use Excel;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_attendance(Request $request){
        if(Auth::user()->role=="Head Master" && $request->user!='report'){//checking role
            return redirect()->back()->with('','');
        }



        $GLOBALS['search'] = $request->search;
        $students = DB::table('students')->where('class',$request->class_id)->orderBy('updated_at','desc')->paginate(1200);
        
        $teachers  = DB::table('teachers')->where('email',Auth::user()->email)->get();
        $teacher_id = '';
        foreach($teachers as $teacher){
            $teacher_id = $teacher->teacher_id;
        }

        if(Auth::user()->role=="Head Master" && $request->user=='report'){
            $classes = DB::table('classes')->orderBy('name','asc')->paginate(25);
        }else{
            $classes = DB::table('classes')->where('teacher_id',$teacher_id)->orderBy('name','asc')->paginate(25);
        }
        if(!empty($request->attendance_date)){
            $date_today =  $request->attendance_date;
        }else{
            $date_today =  date("Y-m-d");
        }
        foreach ($students as $value) {
            $attendance_val = $request->get('attendance_'.$value->student_id);
            $comment_val = $request->get('comment_'.$value->student_id);

            
            if(!empty($attendance_val)){
            $attend = DB::table('attendances')
            ->where('student_id','=',$value->student_id)
            ->where('updated_at','LIKE','%'.$date_today.'%')
            ->orderBy('updated_at','asc')->get();
            if(count($attend)<=0){
                //new attendance
                $attendance = new Attendances();
                $attendance->attendance_id = uniqid();
                $attendance->student_id = $value->student_id;
                $attendance->attendance_status = $attendance_val;
                $attendance->attendance_comment = $comment_val;
                $attendance->save();
            }else{
                //update attendance
                $attendance = attendances::
                where('student_id','=',$value->student_id)
                ->where('updated_at','LIKE','%'.$date_today.'%')->first();
                $attendance->attendance_status = $attendance_val;
                $attendance->attendance_comment = $comment_val;
                $attendance->save();
            }
            }
        }

        $attendances = DB::table('attendances')->where('attendance_date','=',$date_today)->orderBy('updated_at','asc')->paginate(25);
        $attendance_dates = DB::table('attendances')->select('attendance_date')->distinct()->orderBy('attendance_date','desc')->get();


        //send sms
        $count = 0;
        if($request->submit=='attendance'){
        foreach ($students as $student) {
            $count++;
            $parent_phone = "255".substr($student->phone,+1);
            $value_form = "Mzazi wa ".$student->fname." ".$student->tname.";\n Tarehe ".$request->attendance_date." ";
            foreach ($attendances as $attendance) {
            if ($attendance->student_id==$student->student_id) {
                if(strtolower($attendance->attendance_status)=='present'){
                    $attendance->attendance_status = $attendance->attendance_status."(Amehudhuria Shule)";
                }else if(strtolower($attendance->attendance_status)=='absent'){
                    $attendance->attendance_status = $attendance->attendance_status."(Hajahudhuria Shule)";
                }else if(strtolower($attendance->attendance_status)=='permission'){
                    $attendance->attendance_status = $attendance->attendance_status."(Ana Ruhusa)";
                }
                $value_form_ = strtoupper($attendance->attendance_status)."; ";
            }
            }
            $value_form = $value_form.$value_form_;
            //$value_form .= '        Amekuwa Nafasi '.$count.' Kati ya wanafunzi '.count($students).'.      ';
            //ISSA ACCOUNT
            // if($parent_phone){
            //     $response = Http::post('https://rest.nexmo.com/sms/json', [
            //         'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255686518433', 'api_key'=>'7cee0071', 'api_secret'=>'ecDDT27PvlDVh7WQ'
            //     ]);
            // }
            if($parent_phone){
                $response = Http::post('https://rest.nexmo.com/sms/json', [
                    'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255755206870', 'api_key'=>'397e5b86', 'api_secret'=>'ZsmzPTOiz385vc4v'
                ]);
            }
            //MY ACCOUNT
            // if($parent_phone){
            //     $response = Http::post('https://rest.nexmo.com/sms/json', [
            //         'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255621555169', 'api_key'=>'01a2afc7', 'api_secret'=>'uULbCVyeVWAy5Owu'
            //     ]);
            // }
        }
    }


        return view('attendance',['students'=>$students,'classes'=>$classes, 'attendances'=>$attendances, 'attendance_dates'=>$attendance_dates]);
    }

    public function send_attendance(Request $request){
        if(!empty($request->attendance_date)){
            $date_today =  $request->attendance_date;
        }else{
            $date_today =  date("Y-m-d");
        }
        $attendances = DB::table('attendances')->where('attendance_date','=',$request->attendance_date)->orderBy('updated_at','asc')->get();

        $students = DB::table('students')->where('class','LIKE','%'.$request->class_id.'%')->orderBy('total_score','desc')->get();

        $count = 0;
        foreach ($students as $student) {
            $count++;
            $parent_phone = "255".substr($student->phone,+1);
            $value_form = "Mzazi wa ".$student->fname." ".$student->tname.";\n Tarehe ".$request->attendance_date." ";
            foreach ($attendances as $attendance) {
            if ($attendance->student_id==$student->student_id) {
                if(strtolower($attendance->attendance_status)=='present'){
                    $attendance->attendance_status = $attendance->attendance_status."(Amehudhuria Shule)";
                }else if(strtolower($attendance->attendance_status)=='absent'){
                    $attendance->attendance_status = $attendance->attendance_status."(Hajahudhuria Shule)";
                }else if(strtolower($attendance->attendance_status)=='permission'){
                    $attendance->attendance_status = $attendance->attendance_status."(Ana Ruhusa)";
                }
                $value_form_ = strtoupper($attendance->attendance_status)."; ";
            }
            }
            $value_form = $value_form.$value_form_;
            //$value_form .= '        Amekuwa Nafasi '.$count.' Kati ya wanafunzi '.count($students).'.      ';
            //ISSA ACCOUNT
            if($parent_phone){
                $response = Http::post('https://rest.nexmo.com/sms/json', [
                    'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255755206870', 'api_key'=>'397e5b86', 'api_secret'=>'ZsmzPTOiz385vc4v'
                ]);
            }
            //MY ACCOUNT
            // if($parent_phone){
            //     $response = Http::post('https://rest.nexmo.com/sms/json', [
            //         'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255621555169', 'api_key'=>'01a2afc7', 'api_secret'=>'uULbCVyeVWAy5Owu'
            //     ]);
            // }
        }
        return redirect()->back()->with('success','Message Sent!');
    }

    public function exportIntoExcel(Request $request){
        return Excel::download(new AttendancesExport,'attendance_'.$request->attendance_date.'.xlsx');
    }
}
