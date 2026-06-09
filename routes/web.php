<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UmkmProfileController;
use App\Http\Controllers\CariMahasiswaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\ServicesController;

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

Route::get('/services', [ServicesController::class, 'index'])->name('services');

/*
|--------------------------------------------------------------------------
| SERVICE DETAIL
|--------------------------------------------------------------------------
*/

Route::view('/service-detail', 'service-detail')
    ->name('service.detail');


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
    $role = auth()->user()->role;

    if ($role === 'mahasiswa') {
        return redirect()->route('dashboard.mahasiswa');
    }

    if ($role === 'umkm') {
        return redirect()->route('dashboard.umkm');
    }

    return view('dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD MAHASISWA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard-mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/profile-mahasiswa', [ProfileController::class, 'index'])->name('profile.mahasiswa');
    Route::post('/profile-mahasiswa', [ProfileController::class, 'update'])->name('profile.mahasiswa.update');
    Route::get('/portfolio-mahasiswa', [PortfolioController::class, 'index'])->name('portfolio.mahasiswa');
    Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/portfolio-mahasiswa/tambah', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio-mahasiswa', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio-mahasiswa/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio-mahasiswa/{portfolio}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio-mahasiswa/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::get('/layanan-saya', [LayananController::class, 'index'])->name('layanan.saya');
    Route::get('/layanan-saya/tambah', [LayananController::class, 'create'])->name('layanan.create');
    Route::post('/layanan-saya', [LayananController::class, 'store'])->name('layanan.store');
    Route::get('/layanan-saya/{layanan}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan-saya/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan-saya/{layanan}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    Route::get('/layanan-saya/{layanan}/pesanan', [LayananController::class, 'showPesanan'])->name('layanan.pesanan');
    Route::patch('/layanan-saya/{layanan}/ketersediaan', [LayananController::class, 'toggleKetersediaan'])->name('layanan.toggle-ketersediaan');
    Route::patch('/pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('pesanan.update-status');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/start/{user}', [ChatController::class, 'start'])->name('chat.start');
    Route::get('/chat/conversations/{conversation}/messages', [ChatController::class, 'messages'])->name('chat.messages');
    Route::post('/chat/conversations/{conversation}/messages', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/pesanan-saya', [PesananController::class, 'mahasiswaPesanan'])->name('pesanan.saya');
    Route::get('/mahasiswa/{user}', [MahasiswaController::class, 'show'])->name('mahasiswa.profil');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD UMKM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::view('/dashboard-umkm', 'dashboard-umkm')->name('dashboard.umkm');
    Route::get('/profile-umkm', [UmkmProfileController::class, 'index'])->name('profile.umkm');
    Route::post('/profile-umkm', [UmkmProfileController::class, 'update'])->name('profile.umkm.update');
    Route::get('/cari-mahasiswa', [CariMahasiswaController::class, 'index'])->name('cari.mahasiswa');
    Route::get('/pesanan-umkm', [PesananController::class, 'umkmPesanan'])->name('pesanan.umkm');
    Route::post('/pesan/{layanan}', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/favorit-umkm', [FavoritController::class, 'index'])->name('favorit.umkm');
    Route::post('/favorit/{mahasiswa}', [FavoritController::class, 'toggle'])->name('favorit.toggle');
});
 