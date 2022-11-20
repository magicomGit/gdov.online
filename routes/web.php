<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TourismController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [PostController::class, 'lastPosts'])->name('home');


Route::get('/dashboard', function () {
    return redirect('/');
});

require __DIR__.'/auth.php';

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::delete('/pictures/destroy', [PostController::class, 'pictureDestroy'])->name('pictures.destroy');


Route::get('/tourism/map', [TourismController::class, 'index'])->name('tourism.map');
Route::get('/tourism/places', [TourismController::class, 'places'])->name('tourism.places');

Route::get('/profile/news', [ProfileController::class, 'news'])->name('profile.news')->middleware('auth');



Route::prefix('culture')->group(function(){
    Route::get('/history', function () {
             return view('culture.history');
         })->name('culture.history');

    Route::get('/live', function () {
            return view('culture.live');
        })->name('culture.live');

    Route::get('/map', function () {
        return view('culture.map');
        })->name('culture.map');
});



