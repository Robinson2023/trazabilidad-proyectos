<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\globalDashboardController;

Route::redirect('/', '/inventory');

Route::middleware('auth')->group(function () {

    // Warehouse
    Route::get('/warehouse', [WarehouseController::class, 'index']);
    Route::post('/warehouse/movement', [WarehouseController::class, 'storeMovement']);

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index']);

    // Material
    Route::resource('materials', App\Http\Controllers\MaterialController::class);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/material/{code}', [WarehouseController::class, 'findMaterial']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/projects/global-dashboard', [ProjectController::class, 'globalDashboard'])
    ->name('projects.globalDashboard');

Route::get('/projects/{project}/dashboard', [ProjectController::class, 'projectDashboard'])
    ->name('projects.dashboard');
});

Route::get('/projects/global-dashboard', [ProjectController::class, 'globalDashboard']);

Route::get('/projects/executive-dashboard', [ProjectController::class, 'executiveDashboard']);

Route::resource('workers', App\Http\Controllers\WorkerController::class);

Route::get('/projects/{project}/workers', [ProjectController::class, 'assignWorkers']);
Route::post('/projects/{project}/workers', [ProjectController::class, 'storeWorkers']);

require __DIR__.'/auth.php';