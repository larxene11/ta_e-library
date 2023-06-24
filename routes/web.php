<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewTemplateController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard/students', 'allStudent')->name('manage_siswa.all')->middleware(['auth', 'Is_pegawai']);
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'attemptLogin')->name('attempt_login')->middleware('guest');
    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/register', 'attemptRegister')->name('attempt_register')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/dashboard/profile/detail/{user:email}', 'detailProfile')->name('profile.detail')->middleware(['auth', 'Is_pegawai']);
    Route::get('/dashboard/profile/update/{user:email}', 'updateProfile')->name('profile.update')->middleware(['auth', 'Is_pegawai']);
    Route::patch('/dashboard/profile/{user:email}', 'patchProfile')->name('profile.patch')->middleware(['auth', 'Is_pegawai']);
    Route::delete('/dashboard/user/{user:email}', 'deleteUser')->name('manage_user.delete')->middleware(['auth', 'Is_pegawai']);
});

//route view tamplate
Route::controller(ViewTemplateController::class)->group(function () {
    // drop route to view template
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index', ['title' => 'Dashboard | E-Library SMANDUTA']);
    })->name('dashboard')->middleware(['auth', 'Is_pegawai']);
});

Route::middleware(['auth', 'Is_pegawai'])->controller(BookController::class)->group(function () {
    // Book Route
    Route::get('/dashboard/book', 'allBook')->name('manage_book.all');
    Route::get('/dashboard/book/create', 'createBook')->name('manage_book.create');
    Route::post('/dashboard/book/create', 'storeBook')->name('manage_book.store');
    Route::get('/dashboard/book/{books:kode_buku}', 'detailBook')->name('manage_book.detail');
    Route::get('/dashboard/book/{books:kode_buku}/update', 'updateBook')->name('manage_book.update');
    Route::patch('/dashboard/book/{books:kode_buku}', 'patchBook')->name('manage_book.patch');
    Route::delete('/dashboard/book/{books:kode_buku}', 'deleteBook')->name('manage_book.delete');
});

Route::middleware(['auth', 'Is_pegawai'])->controller(CategoryController::class)->group(function (){
    // Category Route
    Route::get('/dashboard/categories', 'allCategory')->name('manage_category.all');
    Route::get('/dashboard/category/create', 'createCategory')->name('manage_category.create');
    Route::post('/dashboard/category/create', 'storeCategory')->name('manage_category.store');
    Route::get('/dashboard/category/{category:id}/update', 'updateCategory')->name('manage_category.update');
    Route::patch('/dashboard/category/{category:id}', 'patchCategory')->name('manage_category.patch');
    Route::delete('/dashboard/category/{category:id}/delete', 'deleteCategory')->name('manage_category.delete');
});

Route::middleware(['auth', 'Is_pegawai'])->controller(PinjamanController::class)->group(function (){
    // Pinjaman Route
    Route::get('/dashboard/pinjaman', 'allPinjaman')->name('manage_pinjaman.all');
    Route::get('/dashboard/pinjaman/create', 'createPinjaman')->name('manage_pinjaman.create');
    Route::post('/dashboard/pinjaman/create', 'storePinjaman')->name('manage_pinjaman.store');
    Route::get('/dashboard/pinjaman/{pinjaman:id}/update', 'updatePinjaman')->name('manage_pinjaman.update');
    Route::patch('/dashboard/pinjaman/{pinjaman:id}', 'patchPinjaman')->name('manage_pinjaman.patch');
    Route::delete('/dashboard/pinjaman/{pinjaman:id}/delete', 'deletePinjaman')->name('manage_pinjaman.delete');
});
