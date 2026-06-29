<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MaterialLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\LaborEntryController;
use App\Http\Controllers\SubcontractingController;

/*
|--------------------------------------------------------------------------
| Ruta principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return auth()->check()
        ? redirect('/inventory')
        : redirect('/login');

});

/*
|--------------------------------------------------------------------------
| Consulta material por código
|--------------------------------------------------------------------------
*/

Route::get(
    '/material/{code}',
    [WarehouseController::class, 'findMaterial']
);

/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Inventario
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/inventory',
        [InventoryController::class, 'index']
    )->name('inventory.index');

    /*
    |--------------------------------------------------------------------------
    | Warehouse
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/warehouse',
        [WarehouseController::class, 'index']
    )->name('warehouse.index');

    Route::post(
        '/warehouse/movement',
        [WarehouseController::class, 'storeMovement']
    )->name('warehouse.movement');

    /*
    |--------------------------------------------------------------------------
    | Materiales
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'materials',
        MaterialController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Proyectos
    |--------------------------------------------------------------------------
    */

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

    Route::get(
        '/projects/{id}/workers',
        [ProjectController::class, 'assignWorkers']
    );

    Route::post(
        '/projects/{project}/workers',
        [ProjectController::class, 'storeWorkers']
    )->name('projects.storeWorkers');

    Route::resource(
        'projects',
        ProjectController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Horas
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/labor',
        [LaborEntryController::class, 'index']
    )->name('labor.index');

    Route::get(
        '/labor/create',
        [LaborEntryController::class, 'create']
    )->name('labor.create');

    Route::post(
        '/labor',
        [LaborEntryController::class, 'store']
    )->name('labor.store');

    /*
    |--------------------------------------------------------------------------
    | Registro materiales
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/material-log',
        [MaterialLogController::class, 'index']
    )->name('material-log.index');

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Usuarios (solo admin)
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        Route::get(
            '/users',
            [UserController::class, 'index']
        )->name('users.index');

        Route::get(
            '/users/create',
            [UserController::class, 'create']
        )->name('users.create');

        Route::post(
            '/users',
            [UserController::class, 'store']
        )->name('users.store');

        Route::put(
            '/users/{user}/role',
            [UserController::class, 'updateRole']
        )->name('users.role');

    });

});

/*
|--------------------------------------------------------------------------
| Workers
|--------------------------------------------------------------------------
*/

Route::resource(
    'workers',
    WorkerController::class
)->middleware([
    'auth',
    'role:admin,management'
]);

/*
|--------------------------------------------------------------------------
| Dashboard Laravel
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware([
    'auth',
    'verified'
])->name('dashboard');

Route::resource(
    'subcontractings',
    SubcontractingController::class
);

require __DIR__.'/auth.php';