<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\category;
use App\Models\Dealday1;
use App\Models\dealday2;
use App\Models\Inventory;
use App\Models\Newyear;
use App\Models\Offer1;
use App\Models\Offer2;
use App\Models\Product;
use App\Models\ProductThumbnail;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function welcome(){

        $banners = Banner::all();
        $categories = category::all();
        $offer1 = Offer1::all();
        $offer2 = Offer2::all();
        $products = Product::all();
        $dealday1 = Dealday1::all();
        $dealday2 = dealday2::all();
        $newyears = Newyear::all();
        return view('frontend.index',[
            'banners'=>$banners,
            'categories'=>$categories,
            'offer1'=>$offer1,
            'offer2'=>$offer2,
            'products'=>$products,
            'dealday1'=>$dealday1,
            'dealday2'=>$dealday2,
            'newyears'=>$newyears,
        ]);
    }

    function product_details($slug){
        $product_id = Product::where('slug', $slug)->first()->id;
        $thumbnails = ProductThumbnail::where('product_id', $product_id)->get();
        $product_info = Product::find($product_id);
        $product_color = Inventory::where('product_id', $product_id)
        ->groupBy('color_id')
        ->selectRaw('sum(color_id) as sum, color_id')
        ->get();
        $product_size = Inventory::where('product_id', $product_id)
        ->groupBy('size_id')
        ->selectRaw('sum(size_id) as sum, size_id')
        ->get();
        return view('frontend.product_details', [
            'thumbnails'=>$thumbnails,
            'product_info'=>$product_info,
            'product_color'=>$product_color,
            'product_size'=>$product_size,
        ]);
    }
}
