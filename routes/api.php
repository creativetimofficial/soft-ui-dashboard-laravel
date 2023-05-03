<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersCrmController;
use App\Http\Controllers\FbProdController;
use App\Http\Controllers\ProdControlController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/firebird-connections', [FbProdController::class, 'getConnections'])->name('firebird-connections');
Route::get('/store-prods', [FbProdController::class, 'getStoreProds'])->name('store-prods');
Route::get('/store-prods-unique', [FbProdController::class, 'getStoreProdsUnique'])->name('store-prods-unique');
Route::get('/store-stock', [FbProdController::class, 'getStockStore'])->name('store-stock');
Route::get('/suppliers-list', [FbProdController::class, 'getSuppliersList'])->name('suppliers-list');
Route::post('/save-product', [FbProdController::class, 'saveProduct'])->name('save-product');
Route::get('/get-logs', [FbProdController::class, 'getLogs'])->name('get-logs');
Route::get('/userscrm', [UsersCrmController::class, 'returnUsersCrm']);
Route::get('/return-images', [ProdControlController::class, 'getImagesApi']);
