<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function subcategory(){
        $categories = category::all();
        $subcategories = Subcategory::all();
        return view('backend.subcategory.subcategory', [
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }

    function subcategory_add(Request $request){
        $request->validate([
            'category'=>'required',
            'subcategory_name'=>'required',
        ]);

        if (Subcategory::where('category_id', $request->category)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('exit', 'Subcategory Already exist');
        }
        Subcategory::insert([
            'category_id'=>$request->category,
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('sub_cat_add', 'Subcategory Add Successful');
    }

    function subcategory_edit($id){
        $categories = category::all();
        $subcategories = Subcategory::find($id);
        return view('backend.subcategory.subcategory_edit', [
            'categories'=> $categories,
            'subcategories'=>$subcategories,
        ]);
    }

    function subcategory_update(Request $request, $id){
        $request->validate([
            'category'=>'required',
            'subcategory_name'=>'required'
        ]);

        Subcategory::find($id)->update([
            'category_id'=> $request->category,
            'subcategory_name'=> $request->subcategory_name
        ]);
        return back()->with('sub_cat_update', 'Subcategory Update Successful');
    }

    function subcategory_delete($id){
        Subcategory::find($id)->delete();
        return back()->with('sub_cat_del', 'Subcategory Delete Successful');
    }
}
