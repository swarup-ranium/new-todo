<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VueController;
use App\Http\Controllers\TaskCategoriesController;

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

Route::get('/', function () {
    return view('task.home');
});


// Route::resource('vue', VueController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::put('task/{task}/toggle-completed', [Taskcontroller::class,'toggleCompleted'])->name('task-toggle-completed');

    Route::resource('task', TaskController::class);

    Route::resource('taskCategory', TaskCategoriesController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
