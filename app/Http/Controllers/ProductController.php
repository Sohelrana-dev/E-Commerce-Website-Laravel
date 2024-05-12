<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\category;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function product(){
        $brands = Brand::all();
        $categories = category::all();
        $subcategories = Subcategory::all();
        return view('backend.product.product_add', [
            'categories'=> $categories,
            'subcategories' => $subcategories,
            'brands'=> $brands,
        ]);
    }

    function getsubcategory(Request $request){
        $str = '<option value="">subcategory select</option>';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach ($subcategories as $subcategory) {
            $str.= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }

    function product_store(Request $request){

            $request->validate([
                    'category_id'=>'required',
                    'subcategory_id'=>'required',
                    'product_name'=>'required',
                    'price'=>'required',
                    'preview'=>'required',
                ]);

            $cleaned_name = preg_replace('/[^A-Za-z0-9 ]/', '', $request->product_name);
            $slug = Str::lower(str_replace(' ', '-', $cleaned_name)).'-'.random_int(20000, 60000);

        $preview = $request->preview;
        $extension = $preview->extension();
        $cleaned_name = preg_replace('/[^A-Za-z0-9 ]/', '', $request->product_name);
        $file_name = Str::lower(str_replace(' ', '-', $cleaned_name)).'-'.random_int(20000, 50000).'.'.$extension;
        image::make($preview)->save(public_path('uploads/product/preview/'.$file_name));

       $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'brand_id'=>$request->brand_id,
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'tag' => is_array($request->tag) ? implode(',', $request->tag) : $request->tag,
            'discount'=>$request->discount,
            'after_discount'=>$request->price - $request->price*$request->discount/100,
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'add_info'=>$request->add_info,
            'preview'=>$file_name,
            'preview'=>$slug,
            'created_at'=>Carbon::now(),
        ]);

        $thumbnails = $request->thumbnail;
        foreach ($thumbnails as $thumbnail) {
            $extension = $thumbnail->extension();
            $cleaned_name = preg_replace('/[^A-Za-z0-9 ]/', '', $request->product_name);
            $file_name = Str::lower(str_replace(' ', '-', $cleaned_name)).'-'.random_int(20000, 50000).'.'.$extension;
            image::make($thumbnail)->save(public_path('uploads/product/thumbnail/'.$file_name));

            ProductThumbnail::insert([
                'product_id'=> $product_id,
                'thumbnail'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }

        return back()->with('product_success', 'Product Add Success');
    }

    function product_list(){
        $products = Product::all();
        return view('backend.product.product_list', [
            'products'=> $products,
        ]);
    }

    function getProductList(Request $request){
       Product::find($request->product_id)->update([
        'status'=> $request->status,
       ]);
    }

    function product_view($product_id){
        $product = product::find($product_id);
        $thumbnails = ProductThumbnail::where('product_id', $product_id)->get();
        return view('backend.product.product_view', [
            'product'=>$product,
            'thumbnails'=>$thumbnails,
        ]);
    }

    function product_edit($product_id){
        $categories = category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $products = Product::find($product_id);
        return view('backend.product.product_edit', [
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'brands'=>$brands,
            'products'=>$products,
        ]);
    }

    function product_update(Request $request, $product_id){
        $product_info = Product::find($product_id);

        if ($request->preview == null) {
            $product_info->update([
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'brand_id'=>$request->brand_id,
                'product_name'=>$request->product_name,
                'price'=>$request->price,
                'discount'=>$request->discount,
                'tag' => is_array($request->tag) ? implode(',', $request->tag) : $request->tag,
                'after_discount'=>$request->price - $request->price*$request->discount/100,
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'add_info'=>$request->add_info,
            ]);
            return back();
        }
        else{
            $image_location = public_path('uploads/product/preview/'. $product_info->preview);
            unlink($image_location);

            $preview = $request->preview;
            $extension = $preview->extension();
            $cleaned_name = preg_replace('/[^A-Za-z0-9 ]/', '', $request->product_name);
            $file_name = Str::lower(str_replace(' ', '-', $cleaned_name)).'-'.random_int(20000, 50000).'.'.$extension;
            image::make($preview)->save(public_path('uploads/product/preview/'.$file_name));

            $product_info->update([
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'brand_id'=>$request->brand_id,
                'product_name'=>$request->product_name,
                'price'=>$request->price,
                'discount'=>$request->discount,
                'tag' => is_array($request->tag) ? implode(',', $request->tag) : $request->tag,
                'after_discount'=>$request->price - $request->price*$request->discount/100,
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'add_info'=>$request->add_info,
                'preview'=>$file_name,
            ]);
            return back();
        }

    }

    function product_delete($product_id){
        $product = Product::find($product_id);
        $image_location = public_path('uploads/product/preview/'. $product->preview);
        unlink($image_location);
        $product->Delete();

       $product_thumbnail =  ProductThumbnail::where('product_id', $product)->get();

       foreach ($product_thumbnail as $thumbnail) { 
        $thumbnail_delete = public_path('uploads/product/thumbnail/'.$thumbnail->thumbnail);
        unlink($thumbnail_delete);
        $product_thumbnail->Delete();
       }
       return back();
    }
}
