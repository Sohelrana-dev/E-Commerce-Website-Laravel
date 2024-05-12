<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DealdayController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NewyearController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Models\category;
use App\Models\ProductThumbnail;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Route;




// Frontend controller
Route::get('/', [FrontendController::class, 'welcome']);
Route::get('product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');

// frontend ========

// banner controller
Route::get('/banner', [BannerController::class, 'banner'])->name('banner');
Route::post('/banner/store', [BannerController::class, 'banner_store'])->name('banner.store');

// offer controler
Route::get('/exciting/offer', [OfferController::class, 'exciting_offer'])->name('exciting.offer');
Route::post('/offer1/update/{offer_id}', [OfferController::class, 'offer1_update'])->name('offer1.update');
Route::post('/offer2/update/{offer_id}', [OfferController::class, 'offer2_update'])->name('offer2.update');

// subscribe
Route::post('email/store', [SubscribeController::class, 'email_store'])->name('email.store');
Route::get('/email/list', [SubscribeController::class, 'email_list'])->name('email.list');

// deal day
Route::get('/dealday', [DealdayController::class, 'deal_day'])->name('deal.day');
Route::post('/dealday1/update/{dealday_id}', [DealdayController::class, 'dealday1_update'])->name('dealday1.update');
Route::post('/dealday2/update/{dealday_id}', [DealdayController::class, 'dealday2_update'])->name('dealday2.update');

// newyear controller
Route::get('/newyear/offer', [NewyearController::class, 'newyear_offer'])->name('newyear.offer');
Route::post('/newyear/update/{newyear_id}', [NewyearController::class, 'newyear_update'])->name('newyear.update');
// frontend ========

// Home controller
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Profile controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

// User controller
Route::get('user/profile', [UserController::class, 'profile'])->name('profile');
Route::post('user/update', [UserController::class, 'user_update'])->name('user.update');
Route::post('/password/update', [UserController::class, 'password_update'])->name('password.update');
Route::post('/photo/update', [UserController::class, 'photo_update'])->name('photo.update');

// home controller
Route::get('/user/list', [HomeController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');
Route::post('/user/add', [HomeController::class, 'user_add'])->name('user.add');


// Category Controller
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/add', [CategoryController::class, 'category_add'])->name('category.add');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
Route::get('/trash/category', [CategoryController::class, 'trash_category'])->name('trash.category');
Route::get('/trash/restore{trash_id}', [CategoryController::class, 'trash_restore'])->name('trash.restore');
Route::get('/trash/delete{trash_id}', [CategoryController::class, 'trash_delete'])->name('trash.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update{category_id}', [CategoryController::class, 'category_update'])->name('category.update');
Route::post('/category/checked', [CategoryController::class, 'check_category'])->name('check.category');
Route::post('/trash/restore', [CategoryController::class, 'trash_check_restore'])->name('trash_category.restore');


// subcategory controller
Route::get('/subcategory',[SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/add', [SubcategoryController::class, 'subcategory_add'])->name('subcategory.add');
Route::get('/subcatgory/edit/{id}', [SubcategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'subcategory_update'])->name('subcategory.update');
Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'subcategory_delete'])->name('subcategory.delete');


// brand controller
Route::get('/brand', [BrandController::class,'brand'])->name('brand');
Route::post('/bran/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/delete/{brand_id}', [BrandController::class, 'brand_delete'])->name('brand.delete');

// product
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/getSubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::post('getProductList', [ProductController::class, 'getProductList']);
Route::get('/peoduct/view/{product_id}', [ProductController::class, 'product_view'])->name('product.view');
Route::get('/product/edit/{product_id}', [ProductController::class, 'product_edit'])->name('product.edit');
Route::post('/product/update/{product_id}', [ProductController::class, 'product_update'])->name('product.update');
Route::get('/product/delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.delete');

// variation controller
Route::get('/variation', [VariationController::class, 'variation'])->name('variation');
Route::post('/color/store', [VariationController::class, 'color_store'])->name('color.store');
Route::post('/size/store', [VariationController::class, 'size_store'])->name('size.store');
Route::get('/color/delete/{color_id}', [VariationController::class, 'color_delete'])->name('color.delete');
Route::get('/size/delete/{size_id}', [VariationController::class, 'size_delete'])->name('size.delete');

// Inventory
Route::get('/inventory/{product_id}', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/inventory/store/{product_id}', [InventoryController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory.delete/{inventory_id}', [InventoryController::class, 'inventoy_delete'])->name('inventory.delete');



