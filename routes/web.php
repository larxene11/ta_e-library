<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewTemplateController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneralController;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard/students', 'allStudent')->name('manage_siswa.all')->middleware(['auth', 'ispegawai']);
    Route::get('/dashboard/employees', 'allPegawai')->name('manage_pegawai.all')->middleware(['auth', 'ispegawai']);
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'attemptLogin')->name('attempt_login')->middleware('guest');
    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/register', 'attemptRegister')->name('attempt_register')->middleware('guest');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/dashboard/profile/detail', 'detailProfile')->name('profile.detail')->middleware(['auth', 'ispegawai']);
    Route::get('/dashboard/profile/update', 'updateProfile')->name('profile.update')->middleware(['auth', 'ispegawai']);
    Route::patch('/dashboard/profile/{user:email}', 'patchProfile')->name('profile.patch')->middleware(['auth', 'ispegawai']);
    Route::delete('/dashboard/user/{user:email}', 'deleteUser')->name('manage_user.delete')->middleware(['auth', 'ispegawai']);
});

Route::controller(GeneralController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::get('/buku/search/results', 'search')->name('buku-search');

    Route::get('/my-account', 'my_account')->name('my-account')->middleware('auth');
});

//route view tamplate
Route::controller(ViewTemplateController::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index', ['title' => 'Dashboard | E-Library SMANDUTA']);
    })->name('dashboard')->middleware(['auth', 'ispegawai']);
});

Route::middleware(['auth', 'ispegawai'])->controller(BookController::class)->group(function () {
    // Book Route
    Route::get('/dashboard/book', 'allBook')->name('manage_book.all');
    Route::get('/dashboard/book/create', 'createBook')->name('manage_book.create');
    Route::post('/dashboard/book/create', 'storeBook')->name('manage_book.store');
    Route::get('/dashboard/book/{book:kode_buku}', 'detailBook')->name('manage_book.detail');
    Route::get('/dashboard/book/{book:kode_buku}/update', 'updateBook')->name('manage_book.update');
    Route::patch('/dashboard/book/{book:kode_buku}', 'patchBook')->name('manage_book.patch');
    Route::delete('/dashboard/book/{book:kode_buku}', 'deleteBook')->name('manage_book.delete');
});

Route::middleware(['auth', 'ispegawai'])->controller(CategoryController::class)->group(function (){
    // Category Route
    Route::get('/dashboard/categories', 'allCategory')->name('manage_category.all');
    Route::get('/dashboard/category/create', 'createCategory')->name('manage_category.create');
    Route::post('/dashboard/category/create', 'storeCategory')->name('manage_category.store');
    Route::get('/dashboard/category/{category:id}/update', 'updateCategory')->name('manage_category.update');
    Route::patch('/dashboard/category/{category:id}', 'patchCategory')->name('manage_category.patch');
    Route::delete('/dashboard/category/{category:id}/delete', 'deleteCategory')->name('manage_category.delete');
});

Route::middleware(['auth', 'ispegawai'])->controller(PinjamanController::class)->group(function (){
    // Pinjaman Route
    Route::get('/dashboard/pinjaman', 'allPinjaman')->name('manage_pinjaman.all');
    Route::get('/dashboard/pinjaman/create', 'createPinjaman')->name('manage_pinjaman.create');
    Route::post('/dashboard/pinjaman/create', 'storePinjaman')->name('manage_pinjaman.store');
    Route::get('/dashboard/pinjaman/{pinjaman:id}/update', 'updatePinjaman')->name('manage_pinjaman.update');
    Route::patch('/dashboard/pinjaman/{pinjaman:id}', 'patchPinjaman')->name('manage_pinjaman.patch');
    Route::delete('/dashboard/pinjaman/{pinjaman:id}/delete', 'deletePinjaman')->name('manage_pinjaman.delete');
});

Route::middleware(['auth', 'ispegawai'])->controller(KunjunganController::class)->group(function (){
    // Pinjaman Route
    Route::get('/dashboard/kunjungan', 'allkunjungan')->name('manage_kunjungan.all');
    Route::get('/dashboard/kunjungan/create', 'createkunjungan')->name('manage_kunjungan.create');
    Route::post('/dashboard/kunjungan/create', 'storekunjungan')->name('manage_kunjungan.store');
    Route::get('/dashboard/kunjungan/{kunjungan:id}/update', 'updatekunjungan')->name('manage_kunjungan.update');
    Route::patch('/dashboard/kunjungan/{kunjungan:id}', 'patchkunjungan')->name('manage_kunjungan.patch');
    Route::delete('/dashboard/kunjungan/{kunjungan:id}/delete', 'deletekunjungan')->name('manage_kunjungan.delete');
});
