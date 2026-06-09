<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\globalDashboardController;
use App\Http\Controllers\MaterialLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;

Route::redirect('/', '/inventory');

Route::middleware('auth')->group(function () {

Route::get(
    '/users',
    [UserController::class, 'index']
)
->middleware('role:admin')
->name('users.index');

Route::get(
    '/users/create',
    [UserController::class, 'create']
)
->middleware('role:admin')
->name('users.create');

Route::post(
    '/users',
    [UserController::class, 'store']
)
->middleware('role:admin')
->name('users.store');

Route::put(
    '/users/{user}/role',
    [UserController::class, 'updateRole']
)
->middleware('role:admin')
->name('users.role');

Route::get(
    '/users/create',
    [UserController::class, 'create']
)
->middleware('role:admin')
->name('users.create');

Route::post(
    '/users',
    [UserController::class, 'store']
)
->middleware('role:admin')
->name('users.store');


    // Warehouse
    Route::post('/warehouse/movement', [WarehouseController::class, 'storeMovement'])
    ->name('warehouse.movement');
    Route::get('/warehouse', [WarehouseController::class, 'index']);

    // Inventory
    Route::get(
            '/inventory',
            [InventoryController::class, 'index']
            )->name('inventory.index');

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

    Route::get(
        '/projects/global-dashboard',
        [ProjectController::class, 'globalDashboard']
    )->name('projects.global-dashboard');

    Route::get(
        '/projects/executive-dashboard',
        [ProjectController::class, 'executiveDashboard']
    )->name('projects.executive-dashboard');

    Route::get(
        '/projects/{project}/dashboard',
        [ProjectController::class, 'projectDashboard']
    )->name('projects.dashboard');

    Route::resource('projects', ProjectController::class);

});

Route::resource(
    'workers',
    WorkerController::class
)->middleware('role:admin,management');

Route::get(
    '/labor',
    [App\Http\Controllers\LaborEntryController::class, 'index']
)->name('labor.index');

Route::get(
    '/labor/create',
    [App\Http\Controllers\LaborEntryController::class, 'create']
)->name('labor.create');

Route::post(
    '/labor',
    [App\Http\Controllers\LaborEntryController::class, 'store']
)->name('labor.store');

Route::get('/projects/{id}/workers', [ProjectController::class, 'assignWorkers']);
Route::post(
    '/projects/{project}/workers',
    [ProjectController::class, 'storeWorkers']
)->name('projects.storeWorkers');

Route::get(
    '/material-log',
    [MaterialLogController::class, 'index']
)->name('material-log.index');



require __DIR__.'/auth.php';