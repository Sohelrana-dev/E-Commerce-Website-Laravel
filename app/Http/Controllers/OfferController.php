<?php

namespace App\Http\Controllers;

use App\Models\Offer1;
use App\Models\Offer2;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    function exciting_offer(){
        $offer1 = Offer1::all();
        $offer2 = Offer2::all();
        return view('backend.offer.offer', [
            'offer1'=>$offer1,
            'offer2'=>$offer2,
        ]);
    }

    function offer1_update(Request $request, $offer_id){
        $offer = Offer1::find($offer_id);

        if($request->image == ''){
            $offer->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'date'=>$request->date,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
        else{
            $image = $request->image;
            $extension = $image->extension();
            $image_name = 'offer'.'-'.random_int(30000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/left/'.$image_name));

            $offer->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'date'=>$request->date,
                'image'=>$image_name,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
    }

    function offer2_update(Request $request, $offer_id){
        $offer = Offer2::find($offer_id);

        if($request->image == ''){
            $offer->update([
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
        else{
            $image = $request->image;
            $extension = $image->extension();
            $image_name = 'offer2'.'-'.random_int(30000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/right/'.$image_name));

            $offer->update([
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'image'=>$image_name,
            ]);
            return back()->with('offer1_suc', 'Update Successful');
        }
    }
}
