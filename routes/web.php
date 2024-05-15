<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest.jwt');
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

Route::post('/login', [UsersController::class, 'login'])->name('loginpost');
Route::post('/register/post', [UsersController::class, 'register'])->name('registerpost');

Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth.jwt');