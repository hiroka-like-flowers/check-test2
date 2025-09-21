<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'index'])->name('products');
/* 商品一覧 */
Route::get('/products/search', [ProductController::class, 'search']);
/* 検索 */
Route::get('/products/register', [ProductController::class, 'add']);
/* 商品登録 */
Route::post('products/{productId}', [ProductController::class, 'store']);
/* 商品詳細 */
Route::post('/products/{productId}/update', [ProductController::class, 'update']);
/* 商品更新 */
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy']);
/* 削除 */