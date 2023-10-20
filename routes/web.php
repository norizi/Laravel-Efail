<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;
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
    return redirect()->route('welcome');
});

Route::post('/loginform', [App\Http\Controllers\WelcomeController::class, 'login'])->name('loginform');
Route::get('/logoutform', [App\Http\Controllers\WelcomeController::class, 'logout'])->name('logoutform');

Route::get('/efail', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/efail-list', [App\Http\Controllers\WelcomeController::class, 'efail_list'])->name('efail.list');

Auth::routes();

//Route::group(['middleware' => 'auth'], function()
////{
     

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/fail-search', [App\Http\Controllers\HomeController::class, 'index'])->name('fail.search');

    Route::get('/movement', [App\Http\Controllers\HomeController::class, 'movement'])->name('movement');  
    Route::post('/movement-store', [App\Http\Controllers\HomeController::class, 'movement_store'])->name('movement.store');
    Route::post('/movement-update', [App\Http\Controllers\HomeController::class, 'movement_update'])->name('movement.update');
    Route::get('/movement-delete/{id}', [App\Http\Controllers\HomeController::class, 'movement_delete'])->name('movement.delete');

    Route::get('/fail', [App\Http\Controllers\HomeController::class, 'fail'])->name('fail');    
    Route::get('/fail-form', [App\Http\Controllers\HomeController::class, 'fail_form'])->name('fail.form');
    Route::post('/fail-store', [App\Http\Controllers\HomeController::class, 'fail_store'])->name('fail.store');
    Route::get('/fail-delete/{id}', [App\Http\Controllers\HomeController::class, 'fail_delete'])->name('fail.delete');
    Route::get('/fail-edit/{id}', [App\Http\Controllers\HomeController::class, 'fail_edit'])->name('fail.edit');
    Route::post('/fail-update', [App\Http\Controllers\HomeController::class, 'fail_update'])->name('fail.update');
    

     
    Route::get('/surat-form', [App\Http\Controllers\HomeController::class, 'surat_form'])->name('surat.form');
    Route::post('/surat-store', [App\Http\Controllers\HomeController::class, 'surat_store'])->name('surat.store');
    Route::get('/surat-delete/{id}', [App\Http\Controllers\HomeController::class, 'surat_delete'])->name('surat.delete');
    Route::get('/surat-edit/{id}', [App\Http\Controllers\HomeController::class, 'surat_edit'])->name('surat.edit');
    Route::post('/surat-in-update', [App\Http\Controllers\HomeController::class, 'suratIn_update'])->name('suratIn.update');
    Route::post('/surat-out-update', [App\Http\Controllers\HomeController::class, 'suratOut_update'])->name('suratOut.update');

    Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
    Route::get('/user-form', [App\Http\Controllers\HomeController::class, 'user_form'])->name('user.form');
    Route::post('/user-store', [App\Http\Controllers\HomeController::class, 'user_store'])->name('user.store'); 
    Route::get('/user-edit/{id}', [App\Http\Controllers\HomeController::class, 'user_edit'])->name('user.edit');
    Route::post('user-update', [App\Http\Controllers\HomeController::class, 'user_update'])->name('user.update');

     
//});