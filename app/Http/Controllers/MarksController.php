<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
//use App\Models\Class;
use App\Models\Results;
use App\Models\Students;
//use App\Http\Controllers\curl_init();
use App\Exports\ResultsExport;
use Excel;

class MarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show_marks(Request $request){
        $GLOBALS['search'] = $request->class;
        

        
        if(empty($request->class) || empty($request->subject)){
            if(!empty($request->class) && !empty($request->subject)){
                $students = DB::table('students')->where(function($query){
                    $query->where('class','LIKE','%'.$GLOBALS['search'].'%');
                })
                ->orderBy('updated_at','desc')->paginate(25);
            }else{
                $students = DB::table('students')
                    ->orderBy('updated_at','desc')->paginate(25);
            }
            $classes = DB::table('classes')
            ->orderBy('updated_at','desc')->paginate(25);
            $subjects = DB::table('subjects')
            ->orderBy('updated_at','desc')->paginate(25);

            //if teachers logon
            $teachers = DB::table('teachers')->where('email',Auth::user()->email)->get('teacher_id');
            foreach ($teachers as $teacher) {
            $timetables = DB::table('timetables')
            ->join('teachers','timetables.teacher_id','=','teachers.teacher_id')
            ->join('subjects','timetables.subject_id','=','subjects.subject_id')
            ->join('classes','timetables.class_id','=','classes.class_id')
            ->where('timetables.teacher_id',$teacher->teacher_id)
            ->orderBy('timetables.updated_at','desc')->get();
            // foreach ($timetables as $timetable) {
            //     $subjects = DB::table('subjects')->where('subject_id',$timetable->subject_id)->get();
            //     $classes = DB::table('classes')->where('class_id',$timetable->class_id)->get();
            // }
            }
            //endif teachers logon
            $alerts = array();
            return view('marks',['timetables'=>$timetables,'students'=>$students,'subjects'=>$subjects,'classes'=>$classes,'alerts'=>$alerts]);
        }else{
            $students = DB::table('students')
            ->where('class',$request->class)
            ->orderBy('students.updated_at','desc')->paginate(25);
            $classes = DB::table('classes')
            ->where('class_id',$request->class)->orderBy('updated_at','desc')->paginate(25);
            $subjects = DB::table('subjects')
            ->where('subject_id',$request->subject)->orderBy('updated_at','desc')->paginate(25);
            $results = DB::table('results')
            ->where('class_id',$request->class)
            ->where('subject_id',$request->subject)->orderBy('updated_at','desc')->paginate(25);

            $alerts = array();
            return view('add_marks',['students'=>$students,'subjects'=>$subjects,'classes'=>$classes,'results'=>$results,'alerts'=>$alerts]);
        }
    }

    public function show_results(Request $request){
        $subjects = DB::table('subjects')->orderBy('updated_at','desc')->paginate(1000);
        $classes = DB::table('classes')->orderBy('updated_at','desc')->paginate(1000);
        $students = DB::table('students')->where('class','LIKE','%'.$request->get('class_id').'%')->orderBy('updated_at','desc')->paginate(1000);

        if(empty($request->get('class_id')) || empty($request->get('student_id'))){
            $results = DB::table('results')
            ->join('students','results.student_id','=','students.student_id')
            ->join('subjects','results.subject_id','=','subjects.subject_id')
            ->where('results.subject_id','=',$request->subject_id)->orderBy('results.updated_at','desc')->paginate(25);
            return view('results',['subjects'=>$subjects,'classes'=>$classes,'students'=>$students,'results'=>$results]);
        }else{
            $results = DB::table('results')
            ->join('students','results.student_id','=','students.student_id')
            ->join('subjects','results.subject_id','=','subjects.subject_id')
            ->join('classes','results.class_id','=','classes.class_id')
            ->where('students.student_id','=',$request->student_id)
            ->orderBy('results.updated_at','desc')->paginate(25);
            return view('results',['subjects'=>$subjects,'classes'=>$classes,'students'=>$students,'results'=>$results]);  
        }
    }

    public function show_reports(Request $request){
        $subjects = DB::table('subjects')->orderBy('updated_at','desc')->paginate(1000);
        $classes = DB::table('classes')->orderBy('name','asc')->paginate(1000);
        $students = DB::table('students')->where('class','LIKE','%'.$request->get('class_id').'%')->orderBy('total_score','desc')->paginate(1000);
       
        $results = DB::table('results')
        ->join('students','results.student_id','=','students.student_id')
        ->join('subjects','results.subject_id','=','subjects.subject_id')
        ->orderBy('results.updated_at','desc')->paginate(25);


        foreach ($students as $student) {
            if(!empty($request->get('class_id'))){
            foreach ($subjects as $subject) {
            $res = DB::table('results')
            ->join('students','results.student_id','=','students.student_id')
            ->join('subjects','results.subject_id','=','subjects.subject_id')
            ->where('results.class_id','=',$request->get('class_id'))
            ->where('results.student_id','=',$student->student_id)
            ->where('results.subject_id','=',$subject->subject_id)
            ->orderBy('results.updated_at','desc')->get();
            if(count($res)>0){
            }else{
                $res = new Results();
                $res->result_id = uniqid();
                $res->class_id = $request->get('class_id');
                $res->student_id = $student->student_id;
                $res->subject_id = $subject->subject_id;
                $res->score = 0;
                $res->result_status = "null";
                $res->save();
            }
            }
        }
        }

        //for grading
        $total_score = 0;
        foreach (DB::table('students')->where('class','LIKE','%'.$request->get('class_id').'%')->get() as $student) {
        $result_query[$student->student_id] = DB::table('results')->where('student_id',$student->student_id)->sum('score');
        $res[$student->student_id] = students::where('student_id',$student->student_id)->first();
        $res[$student->student_id]->total_score = $result_query[$student->student_id];
        $res[$student->student_id]->save();
        }
        
        $alerts = array();
        $alerts[0] = "";
        return view('reports',['subjects'=>$subjects,'classes'=>$classes,'students'=>$students,'results'=>$results,'alerts'=>$alerts]);
       
    }

    public function show_marks_submit(Request $request){
        
        $students = DB::table('students')->
        where('class',$request->class)->orderBy('updated_at','desc')->paginate(25);
        $classes = DB::table('classes')
        ->where('class_id',$request->class)->orderBy('updated_at','desc')->paginate(25);
        $subjects = DB::table('subjects')
        ->where('subject_id',$request->subject)->orderBy('updated_at','desc')->paginate(25);
        

        for ($i=1; $i <= $request->student_num; $i++) {
            $resultsX = DB::table('results')
            ->where('student_id',$request->get("student_id_".$i))
            ->where('class_id',$request->class)
            ->where('subject_id',$request->subject)->get("student_id");
            if(count($resultsX)==0){
                // echo "insert".$request->get("score_".$i);
                        //add new result
                        $results[$i] = new Results();
                        $results[$i]->result_id = uniqid();
                        $results[$i]->class_id = $request->class;
                        $results[$i]->student_id = $request->get("student_id_".$i);
                        $results[$i]->subject_id = $request->subject;
                        $results[$i]->score = $request->get("score_".$i);
                        $results[$i]->result_status = '';
                        $results[$i]->save();
            }else{
                // echo "update".$request->get("score_".$i);
                        //update result
                        $results[$i] = results::
                        where('class_id','=',$request->class)
                        ->where('subject_id','=',$request->subject)
                        ->where('student_id','=',$request->get("student_id_".$i))->first();
                        $results[$i]->score = $request->get("score_".$i);
                        $results[$i]->result_status = '';
                        $results[$i]->save();
            }
        }

        

        $results = DB::table('results')
            ->where('class_id',$request->class)
            ->where('subject_id',$request->subject)->orderBy('updated_at','desc')->paginate(25);

            //return view('add_marks',['students'=>$students,'subjects'=>$subjects,'classes'=>$classes,'results'=>$results])->with('error','Successful Edited!');
            $alerts = array();
            $alerts[0] = "Successful Edited!";

            //return view('add_marks',['students'=>$students,'subjects'=>$subjects,'classes'=>$classes,'results'=>$results,'alerts'=>$alerts]);
            return redirect()->back()->with('success','succesful!');
    }

    public function send_reports(Request $request){

        $results = DB::table('results')
        ->join('students','results.student_id','=','students.student_id')
        ->join('subjects','results.subject_id','=','subjects.subject_id')
        ->where('class_id',$request->class_id)->where('result_status','!=','null')->orderBy('fname','asc')->get();

        $students = DB::table('students')->where('class','LIKE','%'.$request->class_id.'%')->orderBy('total_score','desc')->get();

        $count = 0;
        foreach ($students as $student) {
            $count++;
            $parent_phone = "255".substr($student->phone,+1);
            $value_form = "Mzazi wa ".$student->fname." ".$student->tname.";\n";
            foreach ($results as $result) {
            if ($result->student_id==$student->student_id) {
                $value_form .= $result->name."=".$result->score."; ";
            }
            }
            $value_form .= '        Amekuwa wa: '.$count.' Kati ya wanafunzi '.count($students).'.      ';
            //ISSA ACCOUNT
            // if($parent_phone){
            //     $response = Http::post('https://rest.nexmo.com/sms/json', [
            //         'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255686518433', 'api_key'=>'7cee0071', 'api_secret'=>'ecDDT27PvlDVh7WQ'
            //     ]);
            // }
            //MY ACCOUNT
            // if($parent_phone){
            //     $response = Http::post('https://rest.nexmo.com/sms/json', [
            //         'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255621555169', 'api_key'=>'01a2afc7', 'api_secret'=>'uULbCVyeVWAy5Owu'
            //     ]);
            // }
            if($parent_phone){
                $response = Http::post('https://rest.nexmo.com/sms/json', [
                    'from'=>'Vonage APIs', 'text'=>$value_form, 'to'=>'255755206870', 'api_key'=>'397e5b86', 'api_secret'=>'ZsmzPTOiz385vc4v'
                ]);
            }

        }
        return redirect()->back()->with('success','Message Sent!');
    }
    
    public function exportIntoExcel(Request $request){
        return Excel::download(new ResultsExport,'Results_'.$request->get('class_name').'.xlsx');
    }
}
