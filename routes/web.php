<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');
Route::view('/tentang', 'pages.tentang');
Route::view('/layanan', 'pages.layanan');
Route::view('/produk', 'pages.produk');
Route::view('/karir', 'pages.lowongan');
Route::view('/kontak', 'pages.kontak');