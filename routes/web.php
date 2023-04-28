<?php

use App\Http\Controllers\Backend\Keuangan\JenisTransaksiController;
use App\Http\Controllers\Backend\Keuangan\PembayaranController;
use App\Http\Controllers\Backend\Keuangan\SppController;
use App\Http\Controllers\Backend\Keuangan\TagihanController;
use App\Http\Controllers\Backend\Keuangan\LaporanController;
use App\Http\Controllers\Backend\TataUsaha\GuruController;
use App\Http\Controllers\Backend\TataUsaha\KelolaKelasController;
use App\Http\Controllers\Backend\TataUsaha\MappingController;
use App\Http\Controllers\Backend\TataUsaha\ProfilController as TataUsahaProfilController;
use App\Http\Controllers\Backend\TataUsaha\RombonganBelajarController;
use App\Http\Controllers\Backend\TataUsaha\SiswaController;
use App\Http\Controllers\Backend\Yayasan\ProfilController;
use App\Http\Controllers\Backend\Yayasan\UnitAccountController;
use App\Http\Controllers\Backend\Yayasan\UnitController;
use App\Models\Pembayaran;
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
    return view('home');
});



Auth::routes();

Route::middleware('auth:user,account_yayasan,unit_account')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard.index');
});

Route::middleware('auth:account_yayasan')->group(function(){
    //Yayasan
    Route::resource('profilyayasan', ProfilController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('unitaccount', UnitAccountController::class);
});

Route::middleware('auth:unit_account')->group(function(){
    //Tata Usaha
    Route::resource('profilsekolah', TataUsahaProfilController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::post('siswa-import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::get('siswa-export', [SiswaController::class, 'export'])->name('siswa.export');
    Route::resource('mapping', MappingController::class);
    Route::resource('kelas', KelolaKelasController::class);
    Route::resource('rombel', RombonganBelajarController::class);

    //Keuangan
    Route::resource('pembayaran', PembayaranController::class);
    Route::post('pembayaran/fetch', 'PembayaranController@fetch')->name('pembayaran.fetch'); //Belum Berhasil
    Route::resource('jenistransaksi', JenisTransaksiController::class);
    Route::get('pembayaran/invoice/{id}', [PembayaranController::class, 'invoice'])->name('pembayaran.invoice');
    Route::resource('tagihan', TagihanController::class);
    Route::resource('laporan', LaporanController::class);
});

Route::middleware('auth:unit_account', 'role_id=3')->group(function(){
    //Tata Usaha

    //Keuangan

});
