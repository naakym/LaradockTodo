<?php

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

Route::group(['middleware' => 'auth'], function() {
  //ホームページを作成
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  //フォルダの新規作成機能
  Route::get('/folders/create', [App\Http\Controllers\FolderController::class, 'showCreateForm'])->name('folders.create');
  Route::post('/folders/create', [App\Http\Controllers\FolderController::class, 'create']);

  Route::group(['middleware' => 'can:view,folder'], function() {
  //タスク一覧ページ
  Route::get('/folders/{folder}/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');

  //タスクの新規作成機能
  Route::get('/folders/{folder}/tasks/create', [App\Http\Controllers\TaskController::class, 'showCreateForm'])->name('tasks.create');
  Route::post('/folders/{folder}/tasks/create', [App\Http\Controllers\TaskController::class, 'create']);

  //タスク編集機能
  Route::get('/folders/{folder}/tasks/{task}/edit', [App\Http\Controllers\TaskController::class, 'showEditForm'])->name('tasks.edit');
  Route::post('/folders/{folder}/tasks/{task}/edit', [App\Http\Controllers\TaskController::class, 'edit']);

  });
});

//会員登録機能
Auth::routes();
