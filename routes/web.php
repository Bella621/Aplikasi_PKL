<?php
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\PinjamanController;

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

Auth::routes();

// Route untuk halaman publik
Route::get('/', [App\Http\Controllers\HomePublicController::class, 'index'])->name('homePublic');
Route::get('/', [App\Http\Controllers\HomePublicController::class, 'search'])->name('homePublic.search');


// Grup route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/anggota', [App\Http\Controllers\AnggotaController::class, 'index'])->name('anggota');
    Route::get('/anggota/create', [App\Http\Controllers\AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::get('/pinjaman', [App\Http\Controllers\PinjamanController::class, 'index'])->name('pinjaman');
    Route::get('/pinjaman/create', [App\Http\Controllers\PinjamanController::class, 'create'])->name('pinjaman.create');
    Route::post('/pinjaman/store', [PinjamanController::class, 'store'])->name('pinjaman.store');
    Route::delete('/pinjaman/{id}', [PinjamanController::class, 'destroy'])->name('pinjaman.destroy');
    Route::get('/pinjaman/{id}/edit', [PinjamanController::class, 'edit'])->name('pinjaman.edit');
    Route::put('/pinjaman/{id}', [PinjamanController::class, 'update'])->name('pinjaman.update');
    Route::get('/angsuran', [App\Http\Controllers\AngsuranController::class, 'index'])->name('angsuran');
    Route::get('/angsuran/create', [App\Http\Controllers\AngsuranController::class, 'create'])->name('angsuran.create');
    Route::delete('/angsuran/{id}', [AngsuranController::class, 'destroy'])->name('angsuran.destroy');
    Route::post('/angsuran/store', [App\Http\Controllers\AngsuranController::class, 'store'])->name('angsuran.store');
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
    Route::post('/laporan/print', [App\Http\Controllers\LaporanController::class, 'printIndex'])->name('laporan.printIndex');
    Route::get('/laporan/total_angsuran', [App\Http\Controllers\LaporanController::class, 'total_angsuran'])->name('laporan.total_angsuran');
    Route::get('/logout', function(){
        \Auth::logout();
        return redirect('/home');
    });
});


