<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    function dashboard(){
        return view('dashboard');
    }

    function user_list(){
        $abc = User::where('id', '!=', Auth::id())->get();
        return view('backend.user.user_list', compact('abc'));
    }

    function user_delete($user_id){
        User::find($user_id)->delete();
        return back()->with('user_delete', 'User Delete Successful.');
    }


    function user_add(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password'=>Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),
            'confirm_password'=> 'required',
        ]);

        if ($request->password != $request->confirm_password) {
            return back()->with('con_err', 'Confirm Password Does Not Matched');
        }

        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('add_success', 'User Add Successful');
    }
}
