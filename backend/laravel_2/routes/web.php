<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestBookController::class, 'index']);
Route::post('/comment', [GuestBookController::class, 'store']);
Route::delete('/comment', [GuestBookController::class, 'delete']);
Route::put('/comment', [GuestBookController::class, 'like']);