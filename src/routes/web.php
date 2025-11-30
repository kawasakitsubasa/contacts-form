<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;


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
// 入力フォーム
Route::get('/', [ContactController::class, 'index']);

// 確認ページ
Route::post('/confirm', [ContactController::class, 'confirm']);

// 保存 → サンクス
Route::post('/thanks', [ContactController::class, 'store']);

// 管理画面一覧
Route::get('/admin', [ContactController::class, 'admin'])->middleware('auth');

// 検索
Route::get('/search', [ContactController::class, 'search'])->middleware('auth');

// 検索リセット
Route::get('/reset', [ContactController::class, 'reset'])->middleware('auth');

// 削除
Route::post('/delete', [ContactController::class, 'delete'])->middleware('auth');

// ユーザー登録
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// ログイン
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

// ログアウト
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/export', [ContactController::class, 'export'])->middleware('auth');
