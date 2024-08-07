<?php

use App\Livewire\Home;
use App\Livewire\Laporan;

use App\Livewire\Pelanggan as LivewirePelanggan;
use App\Livewire\Produk;

use App\Livewire\Transaksi;

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
Route::get('/', Home::class );
Route::get('/produk', Produk::class );
Route::get('/pelanggan', LivewirePelanggan::class );
Route::get('/transaksi', Transaksi::class );
Route::get('/laporan', Laporan::class);

});


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/cetak-laporan', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
