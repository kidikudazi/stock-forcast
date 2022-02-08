<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    WebController,
    AdminController
};

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

# public routes
Route::group([
    'prefix' => '/'
], function () {
    Route::get('/', [WebController::class, 'index']);

    Route::post('/', [WebController::class, 'subscribe']);

    Route::view('administrator/login', 'login');

    Route::post('administrator/login', [WebController::class, 'login']);
});

# admin routes
Route::group([
    'prefix' => 'administrator',
    'middleware' => 'admin-auth',
], function () {
    # dashboard
    Route::get('/home', [AdminController::class, 'home']);

    # profile page
    Route::get('/profile', [AdminController::class, 'profile']);

    # update profile
    Route::post('/update/profile', [AdminController::class, 'updateProfile']);

    # update password
    Route::post('/update/password', [AdminController::class, 'updatePassword']);

    # stock page
    Route::get('/stock', [AdminController::class, 'stock']);

    # create stock
    Route::post('/stock', [AdminController::class, 'createStock']);

    # edit stock
    Route::get('/stock/edit/{id}', [AdminController::class, 'editStock']);

    # update stock
    Route::post('/stock/edit/{id}', [AdminController::class, 'updateStock']);

    # delete stock
    Route::delete('/stock/delete', [AdminController::class, 'deleteStock']);

    # logout
    Route::post('/logout', [AdminController::class, 'logout']);
});
