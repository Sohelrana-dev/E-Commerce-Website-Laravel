<?php

namespace App\Http\Controllers;

use App\Models\Dealday1;
use App\Models\dealday2;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DealdayController extends Controller
{
    function deal_day(){
        $dealday1 = Dealday1::all();
        $dealday2 = dealday2::all();
        return view('backend.dealday.dealday',[
            'dealday1'=>$dealday1,
            'dealday2'=>$dealday2,
        ]);
    }

    function dealday1_update(Request $request, $dealday_id){
        $dealday = Dealday1::find($dealday_id);

        if($request->image == ''){
            $dealday->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
        else{
            $image_location = public_path('uploads/dealday/left/'.$dealday->image);
            unlink($image_location);

            $image = $request->image;
            $extension = $image->extension();
            $image_name = 'dealday'.'-'.random_int(30000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/dealday/left/'.$image_name));

            $dealday->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'image'=>$image_name,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
    }
    function dealday2_update(Request $request, $dealday_id){
        $dealday = dealday2::find($dealday_id);

        if($request->image == ''){
            $dealday->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
        else{
            $image_location = public_path('uploads/dealday/right/'.$dealday->image);
            unlink($image_location);

            $image = $request->image;
            $extension = $image->extension();
            $image_name = 'dealday'.'-'.random_int(30000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/dealday/right/'.$image_name));

            $dealday->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'image'=>$image_name,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
    }
}
