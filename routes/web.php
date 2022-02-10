<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    WebController,
    UserController,
    AdminController,
    AdminLoginController,
    UserLoginController
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

    Route::post('/login', [UserLoginController::class, 'login'])->name('login');

    Route::post('/register', [UserLoginController::class, 'register'])->name('register');

});

# admin routes
Route::prefix('administrator')->group(function () {

    Route::view('/', 'administrator.login')->name('administrator.login');
    
    Route::post('/', [AdminController::class, 'login']);

    # dashboard
    Route::get('/home', [AdminController::class, 'home'])->name('administrator.home');

    # profile page
    Route::get('/profile', [AdminController::class, 'profile'])->name('administrator.profile');

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

// User routes
Route::prefix('user')->group(function () {
    // User home page
    Route::get('/home', [UserController::class, 'home'])->name('user.home');

    # profile page
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    # update profile
    Route::post('/update/profile', [UserController::class, 'updateProfile']);

    # update password
    Route::post('/update/password', [UserController::class, 'updatePassword']);

    // farm stocks page
    Route::get('/stocks', [UserController::class, 'stocks']);

    // Search farm stock
    Route::get('/stocks/filter', [UserController::class, 'filterFarmStocks'])->name('user.stock.search');

    // logout
    Route::post('/logout', [UserController::class, 'logout']);
});
