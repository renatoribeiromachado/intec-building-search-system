<?php

use App\Http\Controllers\AssociateWorkController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        // $logout = \Auth::guard('web')->logout();
        
        return view('layouts.dashboard.index');
    })->name('dashboard');

    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('update/{company}', [CompanyController::class, 'update'])->name('company.update');
        Route::delete('{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    });

    Route::prefix('stage')->group(function () {
        Route::get('/', [StageController::class, 'index'])->name('stage.index');
        Route::get('create', [StageController::class, 'create'])->name('stage.create');
        Route::post('store', [StageController::class, 'store'])->name('stage.store');
        Route::get('edit/{stage}', [StageController::class, 'edit'])->name('stage.edit');
        Route::post('update/{stage}', [StageController::class, 'update'])->name('stage.update');
        Route::delete('{stage}', [StageController::class, 'destroy'])->name('stage.destroy');
    });

    Route::prefix('phase')->group(function () {
        Route::get('/', [PhaseController::class, 'index'])->name('phase.index');
        Route::get('create', [PhaseController::class, 'create'])->name('phase.create');
        Route::post('store', [PhaseController::class, 'store'])->name('phase.store');
        Route::get('edit/{phase}', [PhaseController::class, 'edit'])->name('phase.edit');
        Route::post('update/{phase}', [PhaseController::class, 'update'])->name('phase.update');
        Route::delete('{phase}', [PhaseController::class, 'destroy'])->name('phase.destroy');
    });

    Route::prefix('segment')->group(function () {
        Route::get('/', [SegmentController::class, 'index'])->name('segment.index');
        Route::get('create', [SegmentController::class, 'create'])->name('segment.create');
        Route::post('store', [SegmentController::class, 'store'])->name('segment.store');
        Route::get('edit/{segment}', [SegmentController::class, 'edit'])->name('segment.edit');
        Route::put('update/{segment}', [SegmentController::class, 'update'])->name('segment.update');
        Route::delete('{segment}', [SegmentController::class, 'destroy'])->name('segment.destroy');
    });

    Route::prefix('roles')->group(function() {
        Route::get('', [RoleController::class, 'index'])->name('role.index');
        Route::get('create', [RoleController::class, 'create'])->name('role.create');
        Route::post('store', [RoleController::class, 'store'])->name('role.store');
        Route::get('edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('update/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('role.destroy');

        // Route::get('{id}/permissions', 'RolesController@permissions')->name('perm.edit');
        // Route::put('sync/permission-role', 'RolesController@sync_permission_role')->name('perm.sync.permission_role');
    });

    Route::prefix('users')->group(function() {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('user.destroy');

        // Route::get('{id}/permissions', 'RolesController@permissions')->name('perm.edit');
        // Route::put('sync/permission-role', 'RolesController@sync_permission_role')->name('perm.sync.permission_role');
    });

    Route::prefix('works')->group(function() {
        Route::get('', [WorkController::class, 'index'])->name('work.index');
        Route::get('create', [WorkController::class, 'create'])->name('work.create');
        Route::post('store', [WorkController::class, 'store'])->name('work.store');
        Route::get('edit/{work}', [WorkController::class, 'edit'])->name('work.edit');
        Route::put('update/{work}', [WorkController::class, 'update'])->name('work.update');
        Route::delete('{work}', [WorkController::class, 'destroy'])->name('work.destroy');
    });

    Route::prefix('associates')->group(function() {
        Route::prefix('searches')->group(function() {
            Route::get('', AssociateWorkController::class)->name('search.work.index');
        });
    });
});


require __DIR__.'/auth.php';
