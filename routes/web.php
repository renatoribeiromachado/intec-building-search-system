<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StageController;
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

});


require __DIR__.'/auth.php';
