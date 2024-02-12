<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'index']);
// Route::get('/',[ HomeController::class, 'search'])->name('search');


Route::get('/kegiatan-warga',[HomeController::class, 'kegiatan']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('/submit-form', [FormController::class, 'submitForm']);

Route::get('/dashboard',[HomeController::class, 'dashboard'])->middleware('auth');
Route::get('/history',[HomeController::class, 'history'])->middleware('auth');



Route::get('/show/{id}',[HomeController::class, 'show'])->middleware('auth')->name('laporan.show');
Route::delete('/laporan/{id}', [HomeController::class,'destroy'])->name('laporan.destroy');
Route::patch('/show/{id}', [HomeController::class, 'updateStatus'])->name('laporan.updateStatus');