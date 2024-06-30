<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoGameController;
use App\Http\Controllers\DeveloperController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('video-games', VideoGameController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('developers', DeveloperController::class);
    Route::get('developers/{developer}/verify-password', [DeveloperController::class, 'showVerifyPasswordForm'])->name('developers.showVerifyPasswordForm');
    Route::post('developers/{developer}/verify-password', [DeveloperController::class, 'verifyPassword'])->name('developers.verifyPassword');
});


require __DIR__ . '/auth.php';
