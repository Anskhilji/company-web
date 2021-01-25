<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AboutController;
use App\Models\Brand;
use App\Models\HomeAbout;
use App\Models\HomeServices;
use App\Http\Controllers\ServicesController;
use App\Models\MultiPic;
use App\Http\Controllers\ChangePasswordController;
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = Brand::get();
    $about = HomeAbout::first();
    $services = HomeServices::get();
    $images = MultiPic::all();
    return view('home',compact('brands','about','services','images'));
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('about', function (){
   return view('about');
});
//Route::get('about', function (){
//   return view('about');
//})->middleware('check');

//Route::get('/contact', [ContactController::class, 'index'])->name('contact');

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


//Admin All Routes
Route::get('home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('create/slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::post('store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('edit/{id}/slider',[HomeController::class,'EditSlider'])->name('slider.edit');
Route::post('update/{id}/slider',[HomeController::class,'UpdateSlider'])->name('update.slider');
Route::get('delete/{id}/slider',[HomeController::class,'DeleteSlider'])->name('delete.slider');

// Admin all about
Route::get('home/about',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('add/about',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('add/about',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('edit/{id}/about',[AboutController::class,'EditAbout'])->name('about.edit');
Route::post('update/{id}/about',[AboutController::class,'UpdateAbout'])->name('update.about');
Route::get('delete/{id}/about',[AboutController::class,'DeleteAbout'])->name('about.delete');

// Admin all services
Route::get('home/services',[ServicesController::class,'HomeService'])->name('home.services');
Route::get('add/services',[ServicesController::class,'AddService'])->name('add.services');
Route::post('store/services',[ServicesController::class,'StoreService'])->name('store.service');
Route::get('edit/{id}/services',[ServicesController::class,'EditService'])->name('service.edit');
Route::post('update/{id}/services',[ServicesController::class,'UpdateService'])->name('update.service');
Route::get('delete/{id}/services',[ServicesController::class,'DeleteService'])->name('service.delete');

// Home Portfolio page
Route::get('portfolio',[AboutController::class,'Portfolio'])->name('portfolio');

//Admin Home Contact page
Route::get('admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('add/contact',[ContactController::class,'AddContact'])->name('add.contact');
Route::post('store/contact',[ContactController::class,'StoreContact'])->name('store.contact');
Route::get('edit/{id}/contact',[ContactController::class,'EditContact'])->name('contact.edit');
Route::post('update/{id}/contact',[ContactController::class,'UpdateContact'])->name('update.contact');
Route::get('delete/{id}/contact',[ContactController::class,'DeleteContact'])->name('contact.delete');
Route::get('admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');
Route::get('message/{id}/delete',[ContactController::class,'DeleteMessage'])->name('message.delete');

// Home Contact page
Route::get('contact',[ContactController::class,'Contact'])->name('contact');
Route::post('contact/form',[ContactController::class,'ContactForm'])->name('contact.form');

//Change Password and User Profile Route
Route::get('user/password',[ChangePasswordController::class,'ChangePassword'])->name('change.password');
Route::post('update/password',[ChangePasswordController::class,'UpdatePassword'])->name('password.update');

//Change User profile update
Route::get('user/profile',[ChangePasswordController::class,'ProfileUpdate'])->name('profile.update');
Route::post('user/profile/update',[ChangePasswordController::class,'UserProfileUpdate'])->name('update.user.profile');






Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    $users = User::all();
//    $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');
