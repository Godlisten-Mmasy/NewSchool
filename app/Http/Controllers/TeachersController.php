<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Teachers;
use App\Models\User;

class TeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_teachers(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $teachers = DB::table('teachers')
            ->join('users','teachers.email','=','users.email')
            ->where(function($query){
                $query->where('fname','LIKE','%'.$GLOBALS['search'].'%')
                ->orWhere('sname','LIKE','%'.$GLOBALS['search'].'%')
                ->orWhere('tname','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('teachers.updated_at','desc')->paginate(25);
        
        return view('teachers',['teachers'=>$teachers]);
    }

    public function show_add_teachers(){
        return view('add_teachers');
    }

    public function add_teachers(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }
            $validatedData = $request->validate([
                'fname' => 'required|string',
                'sname' => 'required|string',
                'tname' => 'required|string',
            ]);

            $teachers = new teachers();
            $teachers->teacher_id = uniqid();
            $teachers->fname = $request->get('fname');
            $teachers->sname = $request->get('sname');
            $teachers->tname = $request->get('tname');
            $teachers->email = $request->get('email');
            $teachers->phone = $request->get('phone');

            
            $users = new User();
            $users->name = $request->get('fname')." ".$request->get('sname')." ".$request->get('tname');
            $users->email = $request->get('email');
            $users->password = bcrypt(12345678);
            $users->save();

            $teachers->save();
            return redirect()->back()->with('success', 'Teacher Added Succesful!');
        
    }

    public function edit_teachers(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $teachers = DB::table('teachers')->where('teacher_id',$request->get('id'))
            ->where(function($query){
                $query->where('fname','LIKE','%'.$GLOBALS['search'].'%')
                ->orWhere('sname','LIKE','%'.$GLOBALS['search'].'%')
                ->orWhere('tname','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->paginate(25);
        
        return view('update_teachers',['teachers'=>$teachers]);

    }

    public function edit_teachers_submit(Request $request){
        $get_teacher_id = DB::table('teachers')->where('teacher_id','=',$request->id)
            ->get('teacher_id');
        $_teacher_id = "";
        foreach($get_teacher_id as $_teacher_id){
            $_teacher_id = $_teacher_id->teacher_id;
        }   
        
        if($_teacher_id==$request->teacher_id){
            return redirect()->back()->with('error','Not Exists!');
        }

        $teachers = teachers::where('teacher_id',$request->id)->first();
        $teachers->fname = $request->fname;
        $teachers->sname = $request->sname;
        $teachers->tname = $request->tname;
        $teachers->email = $request->email;
        $teachers->phone = $request->phone;

        $users = User::where('email',$request->email)->first();
        $users->name = $request->get('fname')." ".$request->get('sname')." ".$request->get('tname');
        $users->email = $request->get('email');
        $users->save();

        $teachers->save();
        return redirect()->back()->with('success','Successful Edited!');
    }

    public function delete_teachers(Request $request){
        if($request->id){
            $sd = User::where('email',$request->id)->delete();
            return redirect()->back()->with('success','Deleted!');
        }
    }
}
