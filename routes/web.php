<?php

use App\Http\Controllers\PostsController;
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
    return redirect('/login');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::post('/posts', [PostsController::class, 'store']);
    Route::get('/posts/create', [PostsController::class, 'create']);
    Route::get('/posts/edit/{id}', [PostsController::class, 'edit']);
    Route::put('/posts/{id}', [PostsController::class, 'update']);
    Route::delete('/delete/post', [PostsController::class, 'destroy']);
    Route::get('/posts/preview/{id}', [PostsController::class, 'preview']);
    Route::put('/post/updateStatus', [PostsController::class, 'updateStatus']);
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
