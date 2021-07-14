<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\user;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function settings(){
    //     if(Auth::user()->role!="admin"){//checking role
    //         return redirect()->back()->with('','');
    //     }
    //     return view('settings');
    // }

    public function show_passwordchange(){
        return view('settings');
    }

    public function passwordchange(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function show_add_new_user(){
        if(Auth::user()->role!="admin"){//checking role
            return redirect()->back()->with('','');
        }
        return view('add_new_user');
    }

    public function confirm_new_user(Request $request){
        foreach(user::where('email','=',$request->email)->get('email') as $validateEmail){
            if($validateEmail->email){
                return redirect()->back()->with('error','Email Exists!'); 
            }
        }
        $users = new user();
        $users->name = ' ';
        $users->email = $request->email;
        $users->password = ' ';
        $users->role = '';
        $users->save();
        return redirect()->back()->with('status','Successful Added User Email, Registration awaiting!');
    }

    public function show_manage_user(){
        if(Auth::user()->role!="admin"){//checking role
            return redirect()->back()->with('','');
        }
        $users = user::where('name','!=','')->where('role','!=','admin')->get();
        return view('manage_user',['users'=>$users]);
    }

    public function show_user($id){
        if(Auth::user()->role!="admin"){//checking role
            return redirect()->back()->with('','');
        }
        $users = user::where('id','=',$id)->where('role','!=','admin')->get();
        return view('view_user',['users'=>$users]);
    }

    public function user_permission_lock($id){
        $users = user::where('id','=',$id)->first();
        $users->status = 'locked';
        $users->save();
        return redirect()->back()->with('status','user locked');
    }

    public function user_permission_unlock($id){
        $users = user::where('id','=',$id)->first();
        $users->status = '';
        $users->save();
        return redirect()->back()->with('status','user unlocked');
    }
}
