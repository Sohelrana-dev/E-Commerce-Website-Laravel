<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    function email_store(Request $request){
        Subscribe::insert([
            'customer_id'=>1,
            'email'=>$request->email,
        ]);
        return back();
    }

    function email_list(){
        $emails = Subscribe::all();
        return view('backend.email.email_list', [
            'emails'=>$emails,
        ]);
    }
}
