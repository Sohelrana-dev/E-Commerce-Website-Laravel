<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

use function Symfony\Component\String\b;

class UserController extends Controller
{
    function profile(){
        return view('backend.user.profile');
    }

    function user_update(Request $request){
       User::find(Auth::id())->update([
        'name'=>$request->name,
        'email'=>$request->email,
       ]);
       return back()->with('name_update', 'Update Succesfull !');
    }

    function password_update(UserRequest $request){
        $user = User::find(Auth::id());
       if (Hash::check($request->current_password, $user->password)) {
        $user->update([
            'password'=>$request->password
        ]);
        return back()->with('pass_success', 'Password Update Succesfull');
       }

       else{
        return back()->with('pass_error', 'Current Password is Not Matched');
       }
    }

    function photo_update(Request $request){
        $request->validate([
            'photo'=>'required|image|mimes:png,jpg|min:40|max:4220'
        ]);

        if (Auth::user()->photo == null) {
            $image = $request->photo;
            $extension = $image->extension();
            $file_name = Auth::id().'.'.$extension;
            image::Make($image)->save(public_path('uploads/users/'.$file_name));

            User::find(Auth::id())->update([
                'photo'=>$file_name,
            ]);

            return back()->with('photo_suc');
        }
        else{
            $delete_form = public_path('uploads/users/'.Auth::user()->photo);
            unlink($delete_form);

            $image = $request->photo;
            $extension = $image->extension();
            $file_name = Auth::id().'.'.$extension;
            image::Make($image)->save(public_path('uploads/users/'.$file_name));

            User::find(Auth::id())->update([
                'photo'=>$file_name,
            ]);

            return back()->with('photo_suc', 'Photo Update Succefull');
        }


    }
}
