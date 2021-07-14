<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Teachers;
use App\Models\Timetables;
use App\Models\User;


class TimetablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_timetables(Request $request){
       
        $GLOBALS['search'] = $request->search;

        $subjects = DB::table("subjects")->orderBy('updated_at','desc')->get();

        $timetables = DB::table('timetables')
        ->join('teachers','timetables.teacher_id','=','teachers.teacher_id')
        ->join('subjects','timetables.subject_id','=','subjects.subject_id')
        ->join('classes','timetables.class_id','=','classes.class_id')
        ->orderBy('timetables.updated_at','desc')->get();

        return view('timetable',['timetables'=>$timetables,'subjects'=>$subjects]);
    }

    public function show_add_timetable(Request $request){
        $GLOBALS['search'] = $request->search;
        $classes = DB::table('classes')
            ->where(function($query){
                $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->get();
        $subjects = DB::table("subjects")
        ->where(function($query){
            $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
        })
        ->orderBy('updated_at','desc')->get();
        $teachers = DB::table("teachers")
        ->where(function($query){
            $query->where('fname','LIKE','%'.$GLOBALS['search'].'%');
        })
        ->orderBy('updated_at','desc')->get();


        $alerts = array();

        if(!empty($request->teacher_id) || !empty($request->subject_id) || !empty($request->day) || !empty($request->class_id) || !empty($request->class_id) || !empty($request->time_hours) || !empty($request->time_minutes)){
        //if same teacher to be assigned another subject for same time
        $timetables_ = DB::table("timetables")
        ->where('teacher_id','=',$request->teacher_id)
        ->where('day','=',$request->day)
        ->where('time','LIKE',$request->time_hours.'%')
        ->where('to_time','LIKE',$request->to_hours.'%')
        ->orderBy('updated_at','desc')->get();
        
        if(count($timetables_)>0){
            echo "<script>alert('Duplicated Timetable,Teacher Have Class At This time');</script>";
        }else{
            //if another teacher to be assigned another subject for same time
            $timetables_ = DB::table("timetables")
            ->where('class_id','=',$request->class_id)
            ->where('day','=',$request->day)
            ->where('time','LIKE',$request->time_hours.'%')
            ->where('to_time','LIKE',$request->to_hours.'%')
            ->orderBy('updated_at','desc')->get();
            if(count($timetables_)>0){
                echo "<script>alert('Duplicated Timetable, Class Already Taken!');</script>";
            }else{

        $timetables = new timetables();
        $timetables->timetable_id = uniqid();
        $timetables->teacher_id = $request->teacher_id;
        $timetables->subject_id = $request->subject_id;
        $timetables->day = $request->day;
        $timetables->class_id = $request->class_id;
        $timetables->time = $request->time_hours.':'.$request->time_minutes;
        $timetables->to_time = $request->to_hours.':'.$request->to_minutes;
        $timetables->save();
        $alerts["success"] = "Succesful Uploaded!";}
        }
        // else{
        // $alerts["error"] = "Duplicated Class!";
        // }
        }


        return view('add_timetable',["classes"=>$classes,"subjects"=>$subjects,"teachers"=>$teachers,'alerts'=>$alerts]);
    }

    public function show_edit_timetable(Request $request){
        $GLOBALS['search'] = $request->search;
        $classes = DB::table('classes')
            ->where(function($query){
                $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->get();
        $subjects = DB::table("subjects")
        ->where(function($query){
            $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
        })
        ->orderBy('updated_at','desc')->get();
        $teachers = DB::table("teachers")
        ->where(function($query){
            $query->where('fname','LIKE','%'.$GLOBALS['search'].'%');
        })
        ->orderBy('updated_at','desc')->get();


        $timetables = DB::table("timetables")
        ->where('timetable_id','=',$request->id)
        ->orderBy('updated_at','desc')->get();

        $timetables_ = DB::table("timetables")
        ->where('teacher_id','=',$request->teacher_id)
        ->where('day','=',$request->day)
        ->where('time','LIKE',$request->time_hours.'%')
        ->where('to_time','LIKE',$request->to_hours.'%')
        ->orderBy('updated_at','desc')->get();
        
        if(count($timetables_)>0){
            echo "<script>alert('Duplicated Timetable,Teacher Have Class At This time');</script>";
        }else{
            //if another teacher to be assigned another subject for same time
            $timetables_ = DB::table("timetables")
            ->where('class_id','=',$request->class_id)
            ->where('day','=',$request->day)
            ->where('time','LIKE',$request->time_hours.'%')
            ->where('to_time','LIKE',$request->to_hours.'%')
            ->orderBy('updated_at','desc')->get();
            if(count($timetables_)>0){
                echo "<script>alert('Duplicated Timetable, Class Already Taken!');</script>";
            }else{
        if(count($timetables) && !empty($request->class_id)){
            $timetables_update = timetables::where('timetable_id',$request->id)->first();
            $timetables_update->class_id = $request->class_id;
            $timetables_update->teacher_id = $request->teacher_id;
            $timetables_update->subject_id = $request->subject_id;
            $timetables_update->day = $request->day;
            $timetables_update->time = $request->time_hours.':'.$request->time_minutes;
            $timetables_update->to_time = $request->to_hours.':'.$request->to_minutes;
            $timetables_update->save();
            


            $subjects = DB::table("subjects")->orderBy('updated_at','desc')->get();

            $timetables = DB::table('timetables')
            ->join('teachers','timetables.teacher_id','=','teachers.teacher_id')
            ->join('subjects','timetables.subject_id','=','subjects.subject_id')
            ->join('classes','timetables.class_id','=','classes.class_id')
            ->orderBy('timetables.updated_at','desc')->get();

            return view('timetable',['timetables'=>$timetables,'subjects'=>$subjects]);
        }
        }
    }

        return view('update_timetable',["classes"=>$classes,"subjects"=>$subjects,"teachers"=>$teachers,'timetables'=>$timetables]);
    }


    public function delete_timetable(Request $request){
        if($request->id){
            $sd = Timetables::where('timetable_id',$request->id)->delete();
            return redirect()->back()->with('success','Succesful Deleted!');
        }
    }
}
