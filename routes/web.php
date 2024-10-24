<?php

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoricController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
    return Auth::check() ? redirect()->route('dashboard.index') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
    Route::post('/balance', [BalanceController::class, 'store'])->name('balance.store');

    Route::get('/historic', [HistoricController::class, 'index'])->name('historic.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    Route::get('/historics/export/pdf', [HistoricController::class, 'exportPdf'])->name('historic.exportPdf');
    Route::get('/historics/export/xls', [HistoricController::class, 'exportXls'])->name('historic.exportXls');
});

require __DIR__.'/auth.php';
