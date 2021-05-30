<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserRegisterController;
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

Route::get('/', HomeController::class)->name('home');

//Register Route
Route::post('/register',[UserRegisterController::class,'create'])->name('register');
Route::get('/my-account', DashboardController::class)->middleware(['auth:sanctum,web', 'verified'])->name('dashboard');
//User Dashboard Routes
Route::prefix('my-account')->name('dashboard.')->middleware(['auth:sanctum,web', 'verified'])->group(function (){
    Route::get('/', DashboardController::class)->name('index');
    Route::resource('account-details', UserProfileController::class)->only(['index','update']);
});

//User Profile


Route::resource('newsletters', NewsletterController::class)->only('store');
