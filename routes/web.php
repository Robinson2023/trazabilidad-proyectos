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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStepController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\GasEquipmentController;
use App\Http\Controllers\GasCylinderController;
use App\Http\Controllers\GasSettingController;
use App\Services\NewsService;
use App\Http\Controllers\InventoryEntryController;
use App\Http\Controllers\GasCylinderConsumptionController;

/*
|--------------------------------------------------------------------------
| Ruta principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return auth()->check()
        ? redirect()->route('home')
        : redirect('/login');

});

Route::get('/home', function () {

    $news = app(NewsService::class)->getNews();

    return view('home', compact('news'));

})->middleware('auth')->name('home');

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

Route::resource('products', ProductController::class);

Route::resource(
    'products.steps',
    ProductStepController::class
);

Route::get(
    '/projects/{project}/production',
    [ProductionController::class, 'index']
)->name('production.index');

Route::get(
    '/production/{item}',
    [ProductionController::class, 'show']
)->name('production.show');

Route::patch(
    '/production-step/{step}/complete',
    [ProductionController::class, 'completeStep']
)->name('production.complete-step');

Route::get(
    '/projects/{project}/production/add',
    [ProjectController::class, 'addProduction']
)->name('projects.production.add');

Route::post(
    '/projects/{project}/production/add',
    [ProjectController::class, 'storeProduction']
)->name('projects.production.store');

Route::resource(
    'gas-equipments',
    GasEquipmentController::class
);

Route::resource(
    'gas-cylinders',
    GasCylinderController::class
);

Route::get(
    '/gas-settings',
    [GasSettingController::class,'index']
)->name('gas-settings.index');

Route::put(
    '/gas-settings',
    [GasSettingController::class,'update']
)->name('gas-settings.update');

Route::post(
    '/products/{product}/steps/sync',
    [ProductStepController::class,'sync']
)->name('products.steps.sync');

Route::get('/inventory/entry', [InventoryEntryController::class, 'create'])
    ->name('inventory.entry');

Route::post('/inventory/entry', [InventoryEntryController::class, 'store'])
    ->name('inventory.entry.store');

Route::post(
    '/materials/recalculate-costs',
    [MaterialController::class, 'recalculateCosts']
)->name('materials.recalculate');

Route::get(
    '/projects/{project}/workers',
    [ProjectController::class, 'assignWorkers']
)->name('projects.assignWorkers');

Route::post(
    '/projects/{project}/workers',
    [ProjectController::class, 'storeWorkers']
)->name('projects.storeWorkers');

Route::get(
    '/gas-cylinders/{gasCylinder}/consumption',
    [GasCylinderConsumptionController::class, 'create']
)->name('gas-consumptions.create');

Route::post(
    '/gas-cylinders/{gasCylinder}/consumption',
    [GasCylinderConsumptionController::class, 'store']
)->name('gas-consumptions.store');

Route::get(
    '/gas-cylinders/{gasCylinder}/history',
    [GasCylinderConsumptionController::class, 'history']
)->name('gas-consumptions.history');
    
Route::patch(
    '/projects/{project}/finish',
    [ProjectController::class, 'finish']
)->name('projects.finish');

Route::post(
    'gas-cylinders/{gasCylinder}/pending-return',
    [GasCylinderController::class, 'markPendingReturn']
)->name('gas-cylinders.pending-return');

Route::post(
    'gas-cylinders/{gasCylinder}/delivered',
    [GasCylinderController::class, 'markDelivered']
)->name('gas-cylinders.delivered');

Route::get(
    '/inventory/{material}/adjust',
    [InventoryController::class, 'adjust']
)->name('inventory.adjust');

Route::post(
    '/inventory/{material}/adjust',
    [InventoryController::class, 'storeAdjustment']
)->name('inventory.adjust.store');

require __DIR__.'/auth.php';