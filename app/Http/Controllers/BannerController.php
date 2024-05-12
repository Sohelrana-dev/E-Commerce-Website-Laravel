<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    function banner(){
        $categories = category::all();
        $banners = Banner::all();
        return view('backend.banner.banner',[
            'categories'=>$categories,
            'banners'=>$banners,
        ]);
    }

    function banner_store(Request $request){
        $image = $request->banner_image;
        $extension = $image->extension();
        $image_name = 'banner'.'-'.random_int(20000, 40000).'.'.$extension;
        Image::make($image)->save(public_path('uploads/frontend/banner/'.$image_name));

        Banner::insert([
            'banner_title'=>$request->banner_title,
            'banner_image'=>$image_name,
            'category_id'=>$request->category_id,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('banner_suc', 'Banner Add Successful');
    }
}
