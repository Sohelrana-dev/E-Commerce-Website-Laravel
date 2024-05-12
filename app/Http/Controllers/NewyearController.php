<?php

namespace App\Http\Controllers;

use App\Models\Newyear;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class NewyearController extends Controller
{
    function newyear_offer(){
        $newyear = Newyear::all();
        return view('backend.newyear_offer.newyear_offer', [
            'newyear'=>$newyear,
        ]);
    }

    function newyear_update(Request $request, $newyear_id){
        $newyear = Newyear::find($newyear_id);

        if ($request->image == '') {
            if($request->image == ''){
                $newyear->update([
                    'title'=>$request->title,
                    'discount'=>$request->discount,
                ]);
                return back()->with('offer_suc', 'Update Successful');
            }
          }

            else{
                $image_locatin = public_path('uploads/newyear_offer/'.$newyear->image);
                unlink($image_locatin);

                $image = $request->image;
                $extension = $image->extension();
                $image_name = 'newyear'.'-'.random_int(30000, 60000).'.'.$extension;
                Image::make($image)->save(public_path('uploads/newyear_offer/'.$image_name));

                $newyear->update([
                    'title'=>$request->title,
                    'discount'=>$request->discount,
                    'image'=>$image_name,
                ]);
                return back()->with('offer_suc', 'Update Successful');
            }
    }
}
