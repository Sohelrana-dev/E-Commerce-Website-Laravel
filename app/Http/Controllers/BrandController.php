<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('backend.brand.brand', [
            'brands'=>$brands,
        ]);
    }

    function brand_store(Request $request){
        $request->validate([
            'brand_name'=>'required',
            'brand_logo'=>'required|image'
        ]);

        $brand_logo = $request->brand_logo;
        $extension = $brand_logo->extension();
        $file_name = Str::lower(str_replace(' ','-',$request->brand_name)).'.'.$extension;
        image::make($brand_logo)->save('uploads/brand/'.$file_name);

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_logo'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('brand_success', 'Brand Added Successful');
    }

    function brand_delete($brand_id){
        $brand_info = Brand::find($brand_id);

        $brand_logo = public_path('uploads/brand/'.$brand_info->brand_logo);
        unlink($brand_logo);

        $brand_info->delete();
        return back()->with('brand_delete', 'Brand Delete Successful.');
    }
}



