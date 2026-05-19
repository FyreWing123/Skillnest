<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/', 'welcome')->name('home');

Route::view('/contact-us', 'contactus')->name('contact');