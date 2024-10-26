<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TodoController;

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
Route::controller(AccountController::class)->group(function () {
    Route::post('account', 'createAccount');
});

Route::controller(AccountController::class)->middleware(['jwt.auth'])->group(function () {
    //queryString = page, limit, sortBy, sortValue, filterBy, filterValue
    Route::get('account/all', 'getAllAccounts');
    Route::get('account/{accountId}', 'getAccount');
    Route::get('account/{accountId}/info', 'getAccountInfo');
    Route::post('account', 'createAccount');
    Route::put('account/{accountId}', 'updateAccount');
    Route::delete('account/{accountId}', 'deleteAccount');
});

Route::controller(TodoController::class)->middleware(['jwt.auth'])->group(function () {
    Route::get('todo/all', 'getAllTodos');
    Route::get('todo/shared/all', 'getAllSharedTodos');
    Route::get('todo/{todoId}', 'getTodo');
    Route::post('todo', 'createTodo');
    Route::put('todo/{todoId}', 'updateTodo');
    Route::patch('todo/{todoId}', 'shareTodo');
    Route::delete('todo/{todoId}', 'deleteTodo');
});