<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function(){

   Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'users.'], function() {
       Route::resource('user', App\Http\Controllers\User\UserController::class);
       Route::resource('company', App\Http\Controllers\User\CompanyController::class);
   });

    Route::group(['middleware' => 'role:administrator', 'prefix' => 'admin', 'as' => 'admins.'], function(){
        Route::resource('user', App\Http\Controllers\Admin\AdminController::class);
        Route::resource('company', App\Http\Controllers\Admin\CompanyController::class);
    });

    Route::group(['middleware' => 'role:superadministrator', 'prefix' => 'super', 'as' => 'supers.'], function(){
        Route::resource('user', App\Http\Controllers\Super\SuperController::class);
        Route::resource('company' , App\Http\Controllers\Super\CompanyController::class);
    });
});
