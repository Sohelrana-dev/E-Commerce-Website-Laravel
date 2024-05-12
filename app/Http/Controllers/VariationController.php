<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    function variation(){
        $categories = category::all();
        $colors =Color::all();
        return view('backend.variation.variation',[
            'categories'=>$categories,
            'colors'=>$colors,
        ]);
    }

    function color_store(Request $request){

        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('color_suc', 'Color Add Successful');
    }

    function size_store(Request $request){
        Size::insert([
            'category_id'=>$request->category_id,
            'size_name'=>$request->size_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('size_suc', 'Size Add Successful');
    }

    function color_delete($color_id){
        Color::find($color_id)->delete();
        return back()->with('color_del', 'Color Delete Successful');
    }

    function size_delete($size_id){
        Size::find($size_id)->delete();
        return back()->with('size_del', 'Size Delete Successful');
    }
}



