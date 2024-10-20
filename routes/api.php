<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CircumferenceController;
use App\Http\Controllers\PlicometryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\DietModelController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\PhaseModelController;

/**
 *  @OA\Info(
 *      title="s2i_final", 
 *      version="0.8",
 *  ),
 *  
 *  @OA\Server(
 *     url="http://localhost:8000",
 *     description="API Server"
 * ),
 * 
 *  @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * ),
 *  
 **/

//OK
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('jwt.auth');
    Route::get('logged', 'isLogged');
    Route::post('refresh', 'refresh')->middleware('jwt.auth');
});
//OK
Route::controller(AccountController::class)->middleware(['jwt.auth'])->group(function () {
    //queryString = page, limit, sortBy, sortValue, filterBy, filterValue
    Route::get('account/all', 'getAllAccounts');
    Route::get('account/{accountId}', 'getAccount');
    Route::get('account/{accountId}/info', 'getAccountInfo');
    Route::post('account', 'createAccount');
    Route::put('account/{accountId}', 'updateAccount');
    Route::delete('account/{accountId}', 'deleteAccount');
});