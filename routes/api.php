<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VueController;
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

// Route::resource('vue', VueController::class);
Route::get('vue/register', [VueController::class,'register'])->name('vue.register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
