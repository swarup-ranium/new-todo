<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('/', function() { return view('Task.home'); });

Route::get('update-password', function() { return view('profile.update-password-form'); })->name('update-password');

Route::get('task/change-status',[Taskcontroller::class,'changeStatus'])->name('task-change-status');

Route::resource('task', TaskController::class);

Route::get('taskcategory/change-status',[TaskCategoriesController::class,'changeStatus'])->name('taskcategory-change-status');

Route::resource('taskcategory', TaskCategoriesController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
