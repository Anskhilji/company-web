<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;


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
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');
