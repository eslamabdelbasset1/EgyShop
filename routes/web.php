<?php

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
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
});
