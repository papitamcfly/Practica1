<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

Route::post('/login', [UsersController::class, 'login'])->name('loginpost');
Route::post('/register/post', [UsersController::class, 'register'])->name('registerpost');
Route::post('/verifycodepost', [UsersController::class, 'verificarcodigo'])->name('Verifycodepost');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
Route::get('/me', [UsersController::class, 'me'])->name('me');
Route::get('/editlocation', [UsersController::class, 'editlocation'])->name('editlocation');
Route::put('/edit/{id}', [UsersController::class, 'edit'])->name('edituser');
Route::post('/clear-cookie-and-login', [UsersController::class, 'clearCookieAndLogin'])->name('clearCookieAndLogin');
Route::delete('/desactivar/{id}',[UsersController::class,'desactivar'])->name('desactivaruser');
});
