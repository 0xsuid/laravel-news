<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


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
    return view('welcome');
});

Route::get('read', [NewsController::class, 'index']);
Route::get('read/{id}', [NewsController::class, 'show']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // save new post
    Route::post('create', [NewsController::class, 'create']);
    // update post
    Route::post('update/{id}', [NewsController::class, 'update']);
    // delete post
    Route::get('delete/{id}', [NewsController::class, 'destroy']);
});