<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');
Route::view('/tentang', 'pages.tentang');
Route::view('/layanan', 'pages.layanan');
Route::view('/produk', 'pages.produk');
Route::view('/magang', 'pages.magang');
Route::view('/lowongan', 'pages.lowongan');
Route::view('/magang/tahap-1', 'pages.magang-tahap1');
Route::view('/magang/tahap-2', 'pages.magang-tahap2');
Route::view('/kontak', 'pages.kontak');