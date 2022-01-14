<?php

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
// Admin All Route -------------------------------------------------------------------------
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function()
{
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.changePassword');
    Route::post('/admin/update/password', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.updatePassword');

//=======================================================================================================================================
    // Admin All Brand Route =======================
    Route::prefix('brand')->group(function (){
        Route::get('/view', [BrandController::class, 'brandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
        Route::post('/update/{id}',[BrandController::class, 'brandUpdate']);
        Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');

    });

// Admin All Category Route =======================
    Route::prefix( 'category')->group(function (){
        Route::get('/view', [CategoryController::class, 'categoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::post('/update/{id}',[CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

//    All SubCategory Routes
        Route::get('/sub/view', [SubCategoryController::class, 'subCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'subCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subcategory.edit');
        Route::post('/update', [SubCategoryController::class, 'subCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('subcategory.delete');

//    All Sub - SubCategory Routes
        Route::get('/sub/sub/view', [SubCategoryController::class, 'subSubCategoryView'])->name('all.subSubcategory');
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategory']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubCategory']);

        Route::post('/sub/sub/store', [SubCategoryController::class, 'subSubCategoryStore'])->name('subSubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subSubcategory.edit');
        Route::post('/sub/update', [SubCategoryController::class, 'subSubCategoryUpdate'])->name('subSubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subSubcategory.delete');
    });

// Admin All Products Route =======================
    Route::prefix('product')->group(function (){
        Route::get('/add', [ProductController::class, 'addProduct'])->name('add_products');
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage.product');
        Route::post('/store', [ProductController::class, 'productStore'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::post('/update',[ProductController::class, 'productUpdate'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
        Route::post('/image/update', [ProductController::class, 'multiImageUpdate'])->name('update-product-image');
        Route::post('/thambnail/update', [ProductController::class, 'thambnailImageUpdate'])->name('update-product-thambnail');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'multiImageDelete'])->name('product.multiimg.delete');

        Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
    });

// Admin All Brand Route =======================
    Route::prefix('slider')->group(function (){
        Route::get('/view', [SliderController::class, 'sliderView'])->name('manage.slider');
        Route::post('/store', [SliderController::class, 'sliderStore'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
        Route::post('/update',[SliderController::class, 'sliderUpdate'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
        Route::get('/inactive/{id}', [SliderController::class, 'sliderInactive'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
    });
}); // end Middleware admin


Route::middleware(['auth:web'])->group(function()
{
    // User All Route---------------------------------------------------------------------------------------
    Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/', [IndexController::class, 'index'])->name('user.index');
    Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/store', [IndexController::class, 'userUpdateProfile'])->name('user.updateProfile');
    Route::get('/user/change/password', [IndexController::class, 'userChangePassword'])->name('user.changePassword');
    Route::post('/user/update/password', [IndexController::class, 'userUpdatePassword'])->name('user.updatePassword');

}); // end Middleware User
