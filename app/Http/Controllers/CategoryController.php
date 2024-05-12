<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category(){
        $category = category::all();
        return view('backend.category.category', compact('category'));
    }

    function category_add(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
            'icon'=>'required',
        ]);

        $icon = $request->icon;
        $extension = $icon->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.random_int(40000, 60000).'.'.$extension;
        image::make($icon)->save(public_path('uploads/category/'.$file_name));

        category::insert([
            'category_name'=>$request->category_name,
            'icon'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('add_success', 'Category Add Successful');
    }

    function category_soft_delete($category_id){
        category::find($category_id)->delete();
        return back()->with('cat_soft_delete', 'Category Move To Trash.');
    }

    function trash_category(){
        $category = category::onlyTrashed()->get();
        return view('backend.category.trash_category', [
            'trash_category'=>$category,
        ]);
    }

    function trash_restore($trash_id){
        category::onlyTrashed()->find($trash_id)->restore();
        return back()->with('trash_restore', 'Category Restore Successful');
    }

    function trash_delete($trash_id){
        $category_id = category::onlyTrashed()->find($trash_id);
        $file_name = public_path('uploads/category/'.$category_id->icon);
        unlink($file_name);

        Subcategory::where('category_id', $trash_id)->update([
            'category_id'=>5,
        ]);
        $category_id->forceDelete();
        return back()->with('permanent_delete','Category Delete Successul');
    }

    function category_edit($category_id){
        $category = category::find($category_id);
        return view('backend.category.category_edit',[
            'category' => $category
        ]);
    }

    function category_update(Request $request, $id){
        $request->validate([
            'category_name' => 'required',
        ]);

        if ($request->icon == '') {
            category::find($id)->update([
                'category_name'=>$request->category_name,
            ]);
            return back()->with('category_update', 'Category Updated Successful !');
        }
        else {
            $category = category::find($id);
            $file_name = public_path('uploads/category/'. $category->icon);
            unlink($file_name);

            $image = $request->icon;
            $extension = $image->extension();
            $image_name = str::lower(str_replace(' ', '-', $request->category_name)).'-'.random_int(30000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/category/'.$image_name));

            category::find($id)->update([
                'category_name'=>$request->category_name,
                'icon'=>$image_name,
            ]);
        }
        return back()->with('cat_update', 'Category Update Successful !');
    }

    function check_category(Request $request){
        foreach ($request->category_id as $category) {
            category::find($category)->delete();
        }
        return back()->with('cat_delete', 'Category Move To Trash');
    }
    function trash_check_restore(Request $request){

        if ($request->has('restore')) {
            foreach ($request->trash_id as $trash_id) {
                category::onlyTrashed()->find($trash_id)->restore();
            }
            return back();
        }

        elseif ($request->has('delete')) {
            foreach ($request->trash_id as $trash_id) {
                $category = category::onlyTrashed()->find($trash_id);
                $file_name = public_path('uploads/category/'. $category->icon);
                unlink($file_name);

                category::onlyTrashed()->find($trash_id)->forceDelete();
            }
            return back()->with('permanent_delete', 'Category Delete Successful');

        }

    }
}
