<?php

use App\Http\Controllers\AssociateWorkController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\SegmentSubTypeController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Http\Request;
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

    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('update/{company}', [CompanyController::class, 'update'])->name('company.update');
        Route::delete('{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    });

    Route::prefix('stages')->group(function () {
        Route::get('/', [StageController::class, 'index'])->name('stage.index');
        Route::get('create', [StageController::class, 'create'])->name('stage.create');
        Route::post('store', [StageController::class, 'store'])->name('stage.store');
        Route::get('edit/{stage}', [StageController::class, 'edit'])->name('stage.edit');
        Route::post('update/{stage}', [StageController::class, 'update'])->name('stage.update');
        Route::delete('{stage}', [StageController::class, 'destroy'])->name('stage.destroy');
    });

    Route::prefix('phases')->group(function () {
        Route::get('/', [PhaseController::class, 'index'])->name('phase.index');
        Route::get('create', [PhaseController::class, 'create'])->name('phase.create');
        Route::post('store', [PhaseController::class, 'store'])->name('phase.store');
        Route::get('edit/{phase}', [PhaseController::class, 'edit'])->name('phase.edit');
        Route::post('update/{phase}', [PhaseController::class, 'update'])->name('phase.update');
        Route::delete('{phase}', [PhaseController::class, 'destroy'])->name('phase.destroy');
    });

    Route::prefix('segments')->group(function () {
        Route::get('/', [SegmentController::class, 'index'])->name('segment.index');
        Route::get('create', [SegmentController::class, 'create'])->name('segment.create');
        Route::post('store', [SegmentController::class, 'store'])->name('segment.store');
        Route::get('edit/{segment}', [SegmentController::class, 'edit'])->name('segment.edit');
        Route::put('update/{segment}', [SegmentController::class, 'update'])->name('segment.update');
        Route::delete('{segment}', [SegmentController::class, 'destroy'])->name('segment.destroy');
    });

    Route::prefix('segment-sub-types')->group(function () {
        Route::get('/', [SegmentSubTypeController::class, 'index'])->name('segment_sub_type.index');
        Route::get('create', [SegmentSubTypeController::class, 'create'])->name('segment_sub_type.create');
        Route::post('store', [SegmentSubTypeController::class, 'store'])->name('segment_sub_type.store');
        Route::get('edit/{segment_sub_type}', [SegmentSubTypeController::class, 'edit'])->name('segment_sub_type.edit');
        Route::put('update/{segment_sub_type}', [SegmentSubTypeController::class, 'update'])->name('segment_sub_type.update');
        Route::delete('{segment_sub_type}', [SegmentSubTypeController::class, 'destroy'])->name('segment_sub_type.destroy');
    });

    Route::prefix('v1')->group(function () {

        Route::get('segment-sub-types', function (Request $request) {
            $segmentSubTypes = \App\Models\SegmentSubType::whereSegmentId($request->segment)->get();
            return response()->json([
                'segmentSubTypes' => $segmentSubTypes
            ], 200);
        });

        Route::get('stages', function (Request $request) {
            $stages = \App\Models\Stage::wherePhaseId($request->phase)->get();
            return response()->json([
                'stages' => $stages
            ], 200);
        });

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
        
        Route::post('store/{work}', [WorkController::class, 'storeContact'])->name('work.contact.store');
    });

    Route::prefix('associates')->group(function() {
        Route::prefix('searches')->group(function() {
            Route::get('', AssociateWorkController::class)->name('search.work.index');
        });
    });

    Route::prefix('positions')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('position.index');
        Route::get('create', [PositionController::class, 'create'])->name('position.create');
        Route::post('store', [PositionController::class, 'store'])->name('position.store');
        Route::get('edit/{position}', [PositionController::class, 'edit'])->name('position.edit');
        Route::post('update/{position}', [PositionController::class, 'update'])->name('position.update');
        Route::delete('{position}', [PositionController::class, 'destroy'])->name('position.destroy');
    });
});


require __DIR__.'/auth.php';
