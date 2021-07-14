<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Teachers;
use App\Models\Timetables;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_dashboard(){

        $users = User::where('email',Auth::user()->email)->first();
        $users->last_login = date("d-m-Y H:m:i");
        $users->save();
        
        if(Auth::user()->role!="Head Master"){

        $date_today = date('Y');
        $subjects = DB::table("subjects")->orderBy('updated_at','desc')->get();

        $teachers = teachers::where('email',Auth::User()->email)->get();
        foreach($teachers as $teacher){
        $timetables = DB::table('timetables')
        ->join('teachers','timetables.teacher_id','=','teachers.teacher_id')
        ->join('subjects','timetables.subject_id','=','subjects.subject_id')
        ->join('classes','timetables.class_id','=','classes.class_id')
        ->where('timetables.teacher_id',$teacher->teacher_id)
        ->orderBy('timetables.updated_at','desc')->get();
        }
        
        return view('dashboard',['timetables'=>$timetables,'subjects'=>$subjects]);
        }else{
        return view('dashboard');
        }
    }
}
