<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\User;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_classes(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $classes = DB::table('classes')
            ->join('teachers','teachers.teacher_id','=','classes.teacher_id')
            ->where(function($query){
                $query->where('classes.name','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('classes.updated_at','desc')->paginate(25);
        
        return view('classes',['classes'=>$classes]);
    }

    public function show_add_classes(){
        $teachers = DB::table('teachers')->get();
        return view('add_classes',['teachers'=>$teachers]);
    }

    public function show_classes_students(Request $request){
        
        $GLOBALS['search'] = $request->search;
        $students = DB::table('students')
        ->where('class','LIKE','%'.$GLOBALS['search'].'%')->orderBy('updated_at','desc')->paginate(25);
        return view('students',['students'=>$students]);
    }

    public function add_classes(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

            $classes = new classes();
            $classes->class_id = uniqid();
            $classes->teacher_id = $request->teacher_id;
            $classes->name = strtoupper($request->get('name'));

            $classes->save();
            return redirect()->back()->with('success', 'Class Added Succesful!');
        
    }
    
    public function edit_classes(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $classes = DB::table('classes')->where('class_id',$request->get('id'))
            ->where(function($query){
                $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->paginate(25);
        
        $teachers = DB::table('teachers')->get();
        return view('update_classes',['classes'=>$classes,'teachers'=>$teachers]);

    }

    public function edit_classes_submit(Request $request){
        $get_class_id = DB::table('classes')->where('class_id','=',$request->id)
            ->get('class_id');
        $_class_id = "";
        foreach($get_class_id as $_class_id){
            $_class_id = $_class_id->class_id;
        }   
        
        if($_class_id==$request->class_id){
            return redirect()->back()->with('error','Not Exists!');
        }

        $classes = classes::where('class_id',$request->id)->first();
        $classes->name = strtoupper($request->name);
        $classes->teacher_id = strtolower($request->teacher_id);

        $classes->save();
        return redirect()->back()->with('success','Successful Edited!');
    }

    public function delete_classes(Request $request){
        if($request->id){
            $sd = Classes::where('class_id',$request->id)->delete();
            return redirect()->back()->with('success','Deleted!');
        }
    }

}
