<?php

use App\Http\Controllers\Api\control\AuthController;
use App\Http\Controllers\Api\control\CategoryController;
use App\Http\Controllers\Api\control\ProductController;
use App\Http\Controllers\Api\control\UserController;
use App\Http\Controllers\Api\control\RoleController;
use App\Http\Controllers\Api\control\FilterController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('forgotPassword','forgotPassword');
    Route::post('resetpassword','resetpassword')->name('password.reset');
    Route::middleware('auth:api')->group(function (){
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh'); 

        Route::group(['controller' => ProductController::class, 'prefix' => 'control/products','middleware'=>'auth:api'], function () {
            Route::get('', 'index')->middleware(['permission:view product']);
            Route::post('', 'store')->middleware(['permission:add product']);
            Route::put('/{product}', 'update')->middleware(['permission:edit All product|edit My product']);
            Route::delete('/{product}', 'destroy')->middleware(['permission:delete All product|delete My product']);
        });

        Route::group(['controller' => CategoryController::class, 'prefix' => 'control/categories','middleware'=>'auth:api'], function () {
            Route::get('', 'index')->middleware(['permission:view category']);
            Route::post('', 'store')->middleware(['permission:add category']);
            Route::get('/{category}', 'show')->middleware(['permission:view category']);
            Route::put('/{category}', 'update')->middleware(['permission:edit category']);
            Route::delete('/{category}', 'destroy')->middleware(['permission:delete category']);
        });

        Route::group(['controller' => UserController::class, 'prefix' => 'control/users', 'middleware' => 'auth:api'], function () {
            Route::get('', 'index')->middleware(['permission:view my profil|view all profil']);
            Route::put('updateNameEmail/{user}', 'updateNameEmail')->middleware(['permission:edit my profil|edit all profil']);
            Route::put('updatePassword/{user}', 'updatePassword')->middleware(['permission:edit my profil|edit all profil']);
            Route::delete('/{user}', 'destroy')->middleware(['permission:delete my profil|delete all profil']);
            Route::put('changerole/{user}', 'changeRole')->middleware(['permission:change role user']);

        });


    });
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{product}', 'show');
});

Route::get('filter', [FilterController::class, 'filter']);

Route::group(['controller' => RoleController::class, 'prefix' => 'control/roles','middleware'=>'auth:api'], function () {
    Route::get('', 'index')->middleware(['permission:view role']);
    Route::post('', 'store')->middleware(['permission:add role']);
    Route::get('/{role}', 'show')->middleware(['permission:view role']);
    Route::put('/{role}', 'update')->middleware(['permission:edit role']);
    Route::delete('/{role}', 'destroy')->middleware(['permission:delete role']);
});

