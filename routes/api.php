<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});


Route::post('/adduser',[UsersController::class,'add_user']);
Route::post('/addproduct',[ProductsController::class,'add_product']);
Route::delete('/deleteproduct/{productId}', [ProductsController::class, 'delete_product']);
Route::post('/updateproduct', [ProductsController::class, 'update_product']);
Route::get('/getproducts', [ProductsController::class, 'get_products']);