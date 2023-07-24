<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

/** ROUTES v2 */

Route::get('/', function () {
    return view('home', ['title' => 'Home', 'active' => 'home']);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'about',
        'name' => "Carens",
        'email' => 'carenskurniawanwijaya@gmail.com',
        'image' => 'contoh-img.jpeg'
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

/** ================== ROUTES v1 ================== */

// Route::get('/', function () {
//     return view('home', ['title' => 'Home']);
// });

// Route::get('/blog', function () {
//     return view('blog', ['title' => 'Blog', 'posts' => Post::all()]);
// });

// Route::get('/post/{slug}', function ($slug) {
//     return view('post', ["title" => "Single Post", "post" => Post::find($slug)]);
// });

// Route::get('/about', function () {
//     return view('about', [
//         'title' => 'About',
//         'name' => "Carens",
//         'email' => 'carenskurniawanwijaya@gmail.com',
//         'image' => 'contoh-img.jpeg'
//     ]);
// });
