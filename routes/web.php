<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');
Route::view('/tentang', 'pages.tentang');
Route::view('/layanan', 'pages.layanan');
Route::view('/produk', 'pages.produk');
Route::view('/magang', 'pages.magang');
Route::view('/lowongan', 'pages.lowongan');
Route::view('/lowongan/detail', 'pages.detail-lowongan');
Route::view('/lowongan/form', 'pages.form-lamaran');
Route::view('/magang/tahap-1', 'pages.magang-tahap1');
Route::view('/magang/tahap-2', 'pages.magang-tahap2');
Route::view('/magang/selesai', 'pages.magang-selesai')->name('magang.selesai');

Route::post('/magang/selesai', function () {
    return redirect()->route('magang.selesai');
});
Route::view('/kontak', 'pages.kontak');
Route::view('/publikasi', 'pages.publikasi')->name('publikasi.index');
Route::view('/publikasi/flipbook', 'components.flipbook')->name('publikasi.flipbook');