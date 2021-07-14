<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Subjects;
use App\Models\User;

class SubjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function show_subjects(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $subjects = DB::table('subjects')
            ->where(function($query){
                $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->paginate(25);
        
        return view('subjects',['subjects'=>$subjects]);
    }

    public function show_add_subjects(){
        return view('add_subjects');
    }

    public function add_subjects(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

            $subjects = new subjects();
            $subjects->subject_id = uniqid();
            $subjects->name = strtoupper($request->get('name'));

            $subjects->save();
            return redirect()->back()->with('success', 'Subject Added Succesful!');
        
    }
    
    public function edit_subjects(Request $request){
        if(Auth::user()->role!="Head Master"){//checking role
            return redirect()->back()->with('','');
        }

        $GLOBALS['search'] = $request->search;
        $subjects = DB::table('subjects')->where('subject_id',$request->get('id'))
            ->where(function($query){
                $query->where('name','LIKE','%'.$GLOBALS['search'].'%');
            })
            ->orderBy('updated_at','desc')->paginate(25);
        
        return view('update_subjects',['subjects'=>$subjects]);

    }

    public function edit_subjects_submit(Request $request){
        $get_subject_id = DB::table('subjects')->where('subject_id','=',$request->id)
            ->get('subject_id');
        $_subject_id = "";
        foreach($get_subject_id as $_subject_id){
            $_subject_id = $_subject_id->subject_id;
        }   
        
        if($_subject_id==$request->subject_id){
            return redirect()->back()->with('error','Not Exists!');
        }

        $subjects = subjects::where('subject_id',$request->id)->first();
        $subjects->name = strtoupper($request->name);

        $subjects->save();
        return redirect()->back()->with('success','Successful Edited!');
    }

    public function delete_subjects(Request $request){
        if($request->id){
            $sd = Subjects::where('subject_id',$request->id)->delete();
            return redirect()->back()->with('success','Deleted!');
        }
    }

}
