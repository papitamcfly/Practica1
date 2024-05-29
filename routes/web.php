<?php

use App\Http\Controllers\MapsController;
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
Route::get('/verifiycode', function () {
    return view('verifycode');
})->name('verifiycode');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

Route::post('/login', [UsersController::class, 'login'])->name('loginpost');
Route::post('/register/post', [UsersController::class, 'register'])->name('registerpost');
Route::post('/verifycodepost', [UsersController::class, 'verificarcodigo'])->name('Verifycodepost');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
Route::get('/me', [UsersController::class, 'me'])->name('me');
Route::put('/editlocation', [UsersController::class, 'editlocation'])->name('editlocation');
Route::put('/edit/{id}', [UsersController::class, 'edit'])->name('edituser');
Route::post('/clear-cookie-and-login', [UsersController::class, 'clearCookieAndLogin'])->name('clearCookieAndLogin');
Route::delete('/desactivar/{id}',[UsersController::class,'desactivar'])->name('desactivaruser');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth.jwt');
Route::get('/index', [UsersController::class, 'index'])->middleware('auth.jwt')->name('indexusers');
Route::get('/show/{id}', [UsersController::class, 'show'])->middleware('auth.jwt')->name('showuser');
Route::get('/map', [MapsController::class, 'mapview'])->middleware('auth.jwt')->name('maps');
Route::get('/AllMap', [MapsController::class, 'allmapview'])->middleware('auth.jwt')->name('allmap');


