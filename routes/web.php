<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;


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
    return view('login');
})->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard')->name('Dashboard');
    });
    Route::get('/transaksi', [SaleController::class, 'Transaksi'])->name('Transaksi');

    Route::get('/tambahbarang', [BarangController::class, 'TambahBarang'])->name('TambahBarang');
    Route::post('/storebarang', [BarangController::class, 'Store']);

    Route::get('/editbarang/{id}', [BarangController::class, 'EditBarang'])->name('EditBarang');
    Route::post('/editstorebarang/{id}', [BarangController::class, 'EditStore']);

    Route::get('/deletebarang/{id}', [BarangController::class, 'Delete'])->name('DeleteBarang');

    Route::get('/tambahcustomer', [CustomerController::class, 'TambahCustomer'])->name('TambahCustomer');
    Route::post('/storecustomer', [CustomerController::class, 'Store']);

    Route::get('/editcustomer/{id}', [CustomerController::class, 'EditCustomer'])->name('EditCustomer');
    Route::post('/editstorecustomer/{id}', [CustomerController::class, 'EditStore']);

    Route::get('/deletecustomer/{id}', [CustomerController::class, 'Delete'])->name('DeleteCustomer');

    Route::get('/tambahsale', [SaleController::class, 'TambahSale'])->name('TambahSale');
    Route::post('/storesale', [SaleController::class, 'Store']);

    Route::get('/editsale/{id}', [SaleController::class, 'EditSale'])->name('EditSale');
    Route::post('/editstoresale/{id}', [SaleController::class, 'EditStore']);

    Route::post('/tambahbarangcart', [SaleController::class, 'TambahBarang']);
    Route::get('/deletecart/{id}', [SaleController::class, 'Delete'])->name('DeleteCart');
});

Route::post('/postlogin', [LoginController::class, 'PostLogin'])->name('PostLogin');
Route::get('/postlogout', [LoginController::class, 'PostLogout'])->name('PostLogout');
