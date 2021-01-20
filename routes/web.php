<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo "This is Home page";
});

Route::get('about', function (){
   return view('about');
});
//Route::get('about', function (){
//   return view('about');
//})->middleware('check');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

//Category Controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
// Category Update
Route::get('/category/{id}/edit',[CategoryController::class,'Edit'])->name('category.edit');
Route::post('/category/{id}/edit',[CategoryController::class,'Update'])->name('update.category');
Route::get('/category/{id}/restore',[CategoryController::class,'Restore'])->name('category.restore');
Route::get('/category/{id}/permanentDelete',[CategoryController::class,'PDelete'])->name('category.permanentDelete');
// Soft delete Trashed category
Route::get('/category/{id}/softDelete',[CategoryController::class,'SoftDelete'])->name('category.softDelete');


// Brand Controller

Route::get('brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('brand/{id}/edit',[BrandController::class,'Edit'])->name('brand.edit');
Route::post('brand/{id}/update',[BrandController::class,'Update'])->name('update.brand');
Route::get('brand/{id}/delete',[BrandController::class,'Delete'])->name('brand.Delete');

// Multi image route

Route::get('multi/image',[BrandController::class,'MultiPic'])->name('multi.image');
Route::post('multi/add',[BrandController::class,'StoreImg'])->name('multiple.image');





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    $users = User::all();
//    $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');
