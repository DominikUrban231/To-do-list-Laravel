<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
    return redirect()->route('login');
});

// Publiczna ścieżka do udostępniania zadania
Route::get('/shared-task/{token}', [TaskController::class, 'showShared'])->name('tasks.shared');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routing dla zadań
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/{task}/share', [TaskController::class, 'generateShareLink'])->name('tasks.share');
    Route::get('/tasks/{task}/history', [TaskController::class, 'history'])->name('tasks.history');
    
    // Przekieruj dashboard na lista zadań
    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
