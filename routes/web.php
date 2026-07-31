<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\SowingController;
use App\Http\Controllers\SowingPlotController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Rutas protegidas por autenticacion
Route::middleware('auth')->group(function () {

    // Administrador: roles y usuarios
    Route::middleware(\App\Http\Middleware\RoleMiddleware::class . ':Administrador')->group(function () {
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    

    Route::get('/reportes', [ReporteController::class, 'index']);


    Route::get('/reporte/gastos/{id}', [ReporteController::class, 'gastosPorSiembra']);
    Route::get('/reporte/cosecha/{id}', [ReporteController::class, 'cosechaIndividual']);

    // Fincas: index/show para todos los autenticados; CRUD (create/edit/delete) solo Administrador
    Route::get('farms', [FarmController::class, 'index'])->name('farms.index');
    Route::get('farms/{farm}', [FarmController::class, 'show'])->name('farms.show');
    Route::get('farms/create', [FarmController::class, 'create'])->name('farms.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Administrador');
    Route::post('farms', [FarmController::class, 'store'])->name('farms.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Administrador');
    Route::get('farms/{farm}/edit', [FarmController::class, 'edit'])->name('farms.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Administrador');
    Route::put('farms/{farm}', [FarmController::class, 'update'])->name('farms.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Administrador');
    Route::delete('farms/{farm}', [FarmController::class, 'destroy'])->name('farms.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Administrador');

    // Plots (Agricultor full CRUD; others read-only)
    Route::get('plots', [PlotController::class, 'index'])->name('plots.index');
    Route::get('plots/create', [PlotController::class, 'create'])->name('plots.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::post('plots', [PlotController::class, 'store'])->name('plots.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::get('plots/{plot}', [PlotController::class, 'show'])->name('plots.show');
    Route::get('plots/{plot}/edit', [PlotController::class, 'edit'])->name('plots.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::put('plots/{plot}', [PlotController::class, 'update'])->name('plots.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::delete('plots/{plot}', [PlotController::class, 'destroy'])->name('plots.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');

    // Crops (Agricultor full CRUD)
    Route::get('crops', [CropController::class, 'index'])->name('crops.index');
    Route::get('crops/create', [CropController::class, 'create'])->name('crops.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::post('crops', [CropController::class, 'store'])->name('crops.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::get('crops/{crop}', [CropController::class, 'show'])->name('crops.show');
    Route::get('crops/{crop}/edit', [CropController::class, 'edit'])->name('crops.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::put('crops/{crop}', [CropController::class, 'update'])->name('crops.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::delete('crops/{crop}', [CropController::class, 'destroy'])->name('crops.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');

    // Sowings (Agricultor full CRUD)
    Route::get('sowings', [SowingController::class, 'index'])->name('sowings.index');
    Route::get('sowings/create', [SowingController::class, 'create'])->name('sowings.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::post('sowings', [SowingController::class, 'store'])->name('sowings.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::get('sowings/{sowing}', [SowingController::class, 'show'])->name('sowings.show');
    Route::get('sowings/{sowing}/edit', [SowingController::class, 'edit'])->name('sowings.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::put('sowings/{sowing}', [SowingController::class, 'update'])->name('sowings.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::delete('sowings/{sowing}', [SowingController::class, 'destroy'])->name('sowings.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');

    // Sowing-Plots (managed by Agricultor)
    Route::get('sowings-plots', [SowingPlotController::class, 'index'])->name('sowings-plots.index');
    Route::get('sowings-plots/create', [SowingPlotController::class, 'create'])->name('sowings-plots.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::post('sowings-plots', [SowingPlotController::class, 'store'])->name('sowings-plots.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::get('sowings-plots/{id}', [SowingPlotController::class, 'show'])->name('sowings-plots.show');
    Route::get('sowings-plots/{id}/edit', [SowingPlotController::class, 'edit'])->name('sowings-plots.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::put('sowings-plots/{id}', [SowingPlotController::class, 'update'])->name('sowings-plots.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::delete('sowings-plots/{id}', [SowingPlotController::class, 'destroy'])->name('sowings-plots.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');

    // Harvests (Agricultor full CRUD)
    Route::get('harvests', [HarvestController::class, 'index'])->name('harvests.index');
    Route::get('harvests/create', [HarvestController::class, 'create'])->name('harvests.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::post('harvests', [HarvestController::class, 'store'])->name('harvests.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::get('harvests/{harvest}', [HarvestController::class, 'show'])->name('harvests.show');
    Route::get('harvests/{harvest}/edit', [HarvestController::class, 'edit'])->name('harvests.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::put('harvests/{harvest}', [HarvestController::class, 'update'])->name('harvests.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');
    Route::delete('harvests/{harvest}', [HarvestController::class, 'destroy'])->name('harvests.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Administrador');

    // Supplies (Agricultor & Trabajador can CRUD supplies for their farm)
    Route::get('supplies', [SupplyController::class, 'index'])->name('supplies.index');
    Route::get('supplies/create', [SupplyController::class, 'create'])->name('supplies.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::post('supplies', [SupplyController::class, 'store'])->name('supplies.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::get('supplies/{supply}', [SupplyController::class, 'show'])->name('supplies.show');
    Route::get('supplies/{supply}/edit', [SupplyController::class, 'edit'])->name('supplies.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::put('supplies/{supply}', [SupplyController::class, 'update'])->name('supplies.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::delete('supplies/{supply}', [SupplyController::class, 'destroy'])->name('supplies.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');

    // Expenses (Agricultor & Trabajador can CRUD expenses for their farm)
    Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('expenses/create', [ExpenseController::class, 'create'])->name('expenses.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::get('expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::put('expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');
    Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':Agricultor,Trabajador,Administrador');

    // Reportes y utilidades
    Route::get('/reportes', [ReporteController::class, 'index']);
    Route::get('/reporte/gastos/{id}', [ReporteController::class, 'gastosPorSiembra']);
    Route::get('/reporte/cosecha/{id}', [ReporteController::class, 'cosechaIndividual']);
    Route::get('/weather', [WeatherController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/', function () {
    return view('welcome');
    });
});

