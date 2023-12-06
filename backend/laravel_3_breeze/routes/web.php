<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware('auth')->group(function() {
// })

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [GuestBookController::class, 'index'])->name('comments');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/comment', [GuestBookController::class, 'store']);
    Route::delete('/comment', [GuestBookController::class, 'delete']);
    Route::put('/comment', [GuestBookController::class, 'like']);
});

Route::prefix('captcha')->group(function() {
    Route::get('/image', [CaptchaController::class, 'generateImage'])->name('captcha.image');
    Route::get('/', [CaptchaController::class, 'index'])->name('captcha.index');
    Route::post('/', [CaptchaController::class, 'submit'])->middleware('verify.captcha')->name('captcha.submit');
    Route::get('/error', [CaptchaController::class, 'error'])->name('captcha.error');
});

// /captcha CaptchaController::getCaptcha
// /form DemoController::index
// /form DemoController::submitForm
// verify.captcha

require __DIR__.'/auth.php';
