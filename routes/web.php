<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;

/**
 * Webルーティング
 *
 * 目的:
 *  - 公開ページ（ログイン/登録/お問い合わせ）
 *  - 認証必須の会員ページ（商品/マイページ/購入/アカウント）
 *
 * 注意:
 *  - ルート名は Blade/JS から参照されるため変更時は影響範囲に注意
 *  - IDは whereNumber('id') で数値制約
 *  - /products/{id} の詳細は最後に宣言し、他の /products/* より後に置く
 */

Route::get('/', fn () => redirect()->route('product.list'))->name('root'); // トップは一覧へ

// ===== 公開エリア（認証不要） =====
Route::get('/login',     [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('auth.login.submit');

Route::get('/register',  [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

// お問い合わせ（公開）
Route::get('/inquiry',   [ContactController::class, 'showForm'])->name('inquiry.form');
Route::post('/inquiry',  [ContactController::class, 'submitForm'])->name('inquiry.send');

// ===== 認証必須エリア =====
Route::middleware('auth')->group(function () {

    // ログアウト
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // ===== 商品 =====
    Route::get('/products',            [ProductController::class, 'index'])->name('product.list');

    // 作成・登録
    Route::get('/products/create',     [ProductController::class, 'create'])->name('product.create');
    Route::post('/products',           [ProductController::class, 'store'])->name('product.store');

    // 編集・更新
    Route::get('/products/{id}/edit',  [ProductController::class, 'edit'])->name('product.edit')->whereNumber('id');
    Route::put('/products/{id}',       [ProductController::class, 'update'])->name('product.update')->whereNumber('id');

    // いいね
    Route::post('/products/{id}/like', [ProductController::class, 'toggleLike'])->name('product.toggleLike')->whereNumber('id');

    // 出品者向け詳細・削除
    Route::get('/products/{id}/owner', [ProductController::class, 'ownerShow'])->name('product.ownerDetail')->whereNumber('id');
    Route::delete('/products/{id}',    [ProductController::class, 'destroy'])->name('product.destroy')->whereNumber('id');

    // 一般向け詳細（最後に宣言）
    Route::get('/products/{id}',       [ProductController::class, 'show'])->name('product.detail')->whereNumber('id');

    // マイページ
    Route::get('/mypage',              [MypageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/purchases',    [MypageController::class, 'purchases'])->name('mypage.purchases');

    // アカウント
    Route::get('/account/edit',        [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/update',      [AccountController::class, 'update'])->name('account.update');

    // 購入
    Route::get('/purchase/{id}',       [PurchaseController::class, 'showForm'])->name('purchase.form')->whereNumber('id');
    Route::post('/purchase/{id}',      [PurchaseController::class, 'store'])->name('purchase.store')->whereNumber('id');
});
