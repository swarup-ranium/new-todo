<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskCategoriesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('task/fetch-data', [Taskcontroller::class,'fetchData']);

    Route::put('task/{task}/toggle-completed', [Taskcontroller::class,'toggleCompleted']);

    Route::resource('task', TaskController::class);

    Route::resource('taskCategory', TaskCategoriesController::class);
});


