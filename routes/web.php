
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminLoginController;

// Home
Route::view('/', 'home')->name('home');

// Form siswa - publik
Route::get('/students/create', [StudentController::class, 'create'])
    ->name('students.create');

Route::post('/students', [StudentController::class, 'store'])
    ->middleware('throttle:8,1')
    ->name('students.store');

// Login admin
Route::get('/login', [AdminLoginController::class, 'show'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AdminLoginController::class, 'login'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('login.submit');

// Logout untuk pengguna yang login
Route::post('/logout', [AdminLoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Khusus admin
Route::middleware(['auth', 'can:manage-students'])->group(function () {

    Route::get('/students', [StudentController::class, 'index'])
        ->name('students.index');

    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
        ->name('students.edit');

    Route::get('/students/{student}', [StudentController::class, 'show'])
        ->name('students.show');

    Route::put('/students/{student}', [StudentController::class, 'update'])
        ->name('students.update');

    Route::delete('/students/{student}', [StudentController::class, 'destroy'])
        ->name('students.destroy');
});
