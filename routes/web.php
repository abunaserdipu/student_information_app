<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin Route
Route::prefix('admin')->group(function () {
    Route::resource('/student', AdminController::class);
    Route::get('/dashboard', function () {
        return view('admin.admin_dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

// Student Route
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentController::class, 'index'])->name('login_form');
    Route::post('/login/create', [StudentController::class, 'login'])->name('student.login');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard')->middleware('student');
    Route::post('/logout', [StudentController::class, 'logout'])->name('student.logout');
});

require __DIR__ . '/auth.php';
