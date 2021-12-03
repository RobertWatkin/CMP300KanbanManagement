<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\CardsController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//Route::get('/user/{id}', [UserController::class, 'show']);

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
    return redirect('/board');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/board', function () {


//     return view('dashboard');
// })->name('dashboard');

Route::resource('board', BoardsController::class)->middleware(['auth:sanctum', 'verified']);
Route::resource('card', CardsController::class)->middleware(['auth:sanctum', 'verified']);

Route::get('/admin/users', [AdminController::class, 'users'])->middleware(['auth:sanctum', 'verified']);
Route::get('/admin/boards', [AdminController::class, 'boards'])->middleware(['auth:sanctum', 'verified']);
