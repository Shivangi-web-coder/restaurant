<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/redirects', [HomeController::class, 'redirects']);
Route::post('/addcart/{id}', [HomeController::class, 'addcart']);
Route::get('/showcart/{id}', [HomeController::class, 'showcart']);
Route::get('/removecart/{id}', [HomeController::class, 'removecart']);
Route::post('/payment', [HomeController::class, 'payment']);
Route::get('/paypal-success', [HomeController::class, 'payPalSuccess'])->name('paypal_success');
Route::get('/paypal-cancel', [HomeController::class, 'payPalCancel'])->name('paypal_cancel');
Route::get('/users', [AdminController::class, 'user']);
Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
Route::get('/foodmenu', [AdminController::class, 'foodmenu']);
Route::post('/uploadmenu', [AdminController::class, 'uploadmenu']);
Route::get('/deletemenu/{id}', [AdminController::class, 'deletemenu']);
Route::get('/editmenu/{id}', [AdminController::class, 'editmenu']);
Route::post('/updatemenu', [AdminController::class, 'updatemenu']);
Route::post('/reservation', [AdminController::class, 'reservation']);
Route::get('/reservation', [AdminController::class, 'adminreservation']);
Route::get('/foodchef', [AdminController::class, 'foodchef']);
Route::post('/uploadchef', [AdminController::class, 'uploadchef']);
Route::get('/deletechef/{id}', [AdminController::class, 'deletechef']);
Route::get('/editchef/{id}', [AdminController::class, 'editchef']);
Route::post('/updatechef', [AdminController::class, 'updatechef']);
Route::get('/orders', [AdminController::class, 'orders']);
Route::post('/search', [AdminController::class, 'search']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
