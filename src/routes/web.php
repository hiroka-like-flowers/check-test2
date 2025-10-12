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
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);/* 商品一覧 */
    Route::get('search', [ProductController::class, 'search'])->name('products.search');/* 検索 */
    Route::get('register', [ProductController::class, 'showCreateForm'])->name('products.register');/* 商品登録画面 */
    Route::post('register', [ProductController::class, 'create'])->name('products.create');/* 商品登録 */
    Route::get('{productId}', [ProductController::class, 'show'])->name('products.show');/* 商品詳細 */
    Route::patch('{productId}/update', [ProductController::class, 'update'])->name('products.update');/* 商品更新 */
    Route::delete('{productId}/delete', [ProductController::class, 'destroy']);/* 削除 */
});