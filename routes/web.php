<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fronted\FrontendViewController;

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
Route::get('/',[FrontendViewController::class,'index'])->name('homapage');
Route::get('/singlepage/{id}',[FrontendViewController::class,'singlepage'])->name('singlepage');


Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix'=>'/admin'],function(){
    //For Product
    Route::group(['prefix'=>'/product'],function(){
  
      Route::post('/store','App\Http\Controllers\Backend\ProductController@store')->middleware(['auth'])->name('store');
      
      Route::get('/create','App\Http\Controllers\Backend\ProductController@create')->middleware(['auth'])->name('create');
  
      Route::get('/manage','App\Http\Controllers\Backend\ProductController@index')->middleware(['auth'])->name('manage');
  
      Route::get('/edit/{id}','App\Http\Controllers\Backend\ProductController@edit')->middleware(['auth'])->name('edit');
  
      Route::post('/update/{id}','App\Http\Controllers\Backend\ProductController@update')->middleware(['auth'])->name('update');
  
      Route::get('/delete/{id}','App\Http\Controllers\Backend\ProductController@destroy')->middleware(['auth'])->name('delete');
    });
});

require __DIR__.'/auth.php';
