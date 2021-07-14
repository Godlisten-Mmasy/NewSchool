<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Students;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show_students(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $students = DB::table('students')->join('classes','students.class','=','classes.class_id')
        ->where(function($query){
            $query->where('fname','LIKE','%'.$GLOBALS['search'].'%')
            ->orWhere('sname','LIKE','%'.$GLOBALS['search'].'%')
            ->orWhere('tname','LIKE','%'.$GLOBALS['search'].'%');
        })
        ->orderBy('students.updated_at','desc')->paginate(25);
        return view('students',['students'=>$students]);
    }

    public function show_add_students(Request $request){
        $classes = DB::table('classes')
            ->orderBy('updated_at','desc')->paginate(25);
        return view('add_students',['classes'=>$classes]);
    }

    public function add_students(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }
            $validatedData = $request->validate([
                'fname' => 'required|string',
                'sname' => 'required|string',
                'tname' => 'required|string',
            ]);

            $students = new Students();
            $students->student_id = uniqid();
            $students->fname = $request->get('fname');
            $students->sname = $request->get('sname');
            $students->tname = $request->get('tname');
            $students->class = $request->get('class_id');
            $students->phone = $request->get('phone');

            $students->save();
            return redirect()->back()->with('success', 'Student Added Succesful!');
        
    }

    public function edit_students(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $students = DB::table('students')->where('student_id',$request->get('id'))
            ->where(function($query){
                $query->where('fname','LIKE','%'.$GLOBALS['search'].'%')
                ->orWhere('sname','LIKE','%'.$GLOBALS['search'].'%')
                ->orWhere('tname','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->paginate(25);

        $classes = DB::table('classes')
        ->orderBy('updated_at','desc')->get();
        
        return view('update_students',['students'=>$students,'classes'=>$classes]);

    }

    public function edit_students_submit(Request $request){
        $get_student_id = DB::table('students')->where('student_id','=',$request->id)
            ->get('student_id');
        $_student_id = "";
        foreach($get_student_id as $_student_id){
            $_student_id = $_student_id->student_id;
        }   
        
        if($_student_id==$request->student_id){
            return redirect()->back()->with('error','Batch No Exists!');
        }

        $students = students::where('student_id',$request->id)->first();
        $students->fname = $request->fname;
        $students->sname = $request->sname;
        $students->tname = $request->tname;
        $students->class = $request->class;
        $students->phone = $request->phone;

        $students->save();
        return redirect()->back()->with('success','Successful Edited!');
    }

    public function delete_students(Request $request){
        if($request->id){
            $sd = students::where('student_id',$request->id)->delete();
            return redirect()->back()->with('status','Deleted!');
        }
    }
}
