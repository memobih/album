<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { 
    return redirect()->route('albums.index');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('albums',\App\Http\Controllers\AlbumController::class);
Route::resource('pictures',\App\Http\Controllers\PictureController::class);
Route::post('picture/restore/{id}',[\App\Http\Controllers\PictureController::class,'restore'])->name('picure.restore');
Route::delete('picture/force/delete/{id}',[\App\Http\Controllers\PictureController::class,'forceDelete'])->name('picture.forceDelete');