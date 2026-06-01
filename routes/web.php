<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::view('/contact-us', 'contactus')->name('contact');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send');

/*
|--------------------------------------------------------------------------
| FAQ
|--------------------------------------------------------------------------
*/

Route::get('/faqs', function () {
    return view('faqs');
})->name('faqs');

/*
|--------------------------------------------------------------------------
| ABOUT US
|--------------------------------------------------------------------------
*/

Route::view('/about-us', 'aboutus')->name('aboutus');


/*
|--------------------------------------------------------------------------
| SERVICES
|--------------------------------------------------------------------------
*/

Route::view('/services', 'services')->name('services');

/*
|--------------------------------------------------------------------------
| SERVICE DETAIL
|--------------------------------------------------------------------------
*/

Route::view('/service-detail', 'service-detail')
    ->name('service.detail');

/*
|--------------------------------------------------------------------------
| CHAT
|--------------------------------------------------------------------------
*/
Route::get('/chat', function () {
    return view('chat');
})->name('chat');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/daftar', [RegisterController::class, 'index'])
    ->name('register');

Route::post('/daftar', [RegisterController::class, 'store'])
    ->name('register.store');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

// halaman login
Route::get('/masuk', [LoginController::class, 'index'])
    ->name('login');

// proses login
Route::post('/masuk', [LoginController::class, 'authenticate'])
    ->name('login.authenticate');

// logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD MAHASISWA
|--------------------------------------------------------------------------
*/

Route::view(
    '/dashboard-mahasiswa',
    'dashboard-mahasiswa'
)->name('dashboard.mahasiswa');

Route::view(
    '/profile-mahasiswa',
    'profile-mahasiswa'
)->name('profile.mahasiswa');

Route::view(
    '/portfolio-mahasiswa',
    'portfolio-mahasiswa' 
)->name('portfolio.mahasiswa');

Route::view(
    '/layanan-saya',
    'layanan-saya'
)->name('layanan.saya');

Route::view(
    '/tambah-layanan',
    'tambah-layanan'
)->name('layanan.create');

Route::view(
    '/chat',
    'chat'
)->name('chat');

/*
|--------------------------------------------------------------------------
| DASHBOARD UMKM
|--------------------------------------------------------------------------
*/
Route::view('/dashboard-umkm', 'dashboard-umkm')->name('dashboard.umkm');
Route::view('/profile-umkm', 'profile-umkm')->name('profile.umkm');
Route::view('/cari-mahasiswa', 'cari-mahasiswa')->name('cari.mahasiswa');
Route::view('/pesanan-umkm', 'pesanan-umkm')->name('pesanan.umkm');
Route::view('/favorit-umkm', 'favorit-umkm')->name('favorit.umkm');
 