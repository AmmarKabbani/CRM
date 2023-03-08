<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

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

Route::group(['middleware' => 'api'], function ($routes) {
    Route::post('/registerCustomer',[AuthController::class , "register"]);
    Route::post('/login',[AuthController::class , "login"]);
    Route::get('/customerInfo/customerId={id}',[CustomerController::class , "Customer_info"]);
    Route::get('/customersInfo',[CustomerController::class , "Customers_info"]);
});