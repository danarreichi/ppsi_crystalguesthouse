<?php

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

Route::get('/', 'guesthousecontroller@tampillogin');

Route::post('periksalogin', 'guesthousecontroller@periksalogin');

Route::get('mainMenu', 'guesthousecontroller@tampilmainmenu');

Route::get('logout', 'guesthousecontroller@logout');

//Routing Master
Route::get('master/{loc}', 'guesthousecontroller@master');

//Routing Reservasi
Route::get('reservasi/{loc}', 'guesthousecontroller@reservasi');

//Routing Tamu
Route::get('tamu/{loc}', 'guesthousecontroller@tamu');

//Routing History
Route::get('historylaporan/{loc}', 'guesthousecontroller@history');

//History
Route::post('historylaporan/historyReservasi/filter', 'guesthousecontroller@historyreservasi_filter');
Route::post('historylaporan/historyTamu/filter', 'guesthousecontroller@historytamu_filter');
Route::post('historylaporan/historyKeluhan/filter', 'guesthousecontroller@historykeluhan_filter');
Route::post('historylaporan/historyReservasi/cetak', 'guesthousecontroller@cetak_historyReservasi');
Route::post('historylaporan/historyTamu/cetak', 'guesthousecontroller@cetak_historyTamu');

// Tamu
Route::get('tamu/konfirmasi/{id_reservasi}', 'guesthousecontroller@tampil_konfirmasi');
Route::get('tamu/konfirmasi/{id_reservasi}/{id_kamar}/berhasil', 'guesthousecontroller@tamu_berhasil_checkin');
Route::get('tamu/konfirmasiCheckOut/{id_tamu}', 'guesthousecontroller@tampil_edit_checkout');
Route::post('tamu/konfirmasiCheckOut_Act', 'guesthousecontroller@tamu_berhasil_checkout');
Route::post('tamu/mainKeluhan/actiontambah_keluhan', 'guesthousecontroller@actiontambah_keluhan');
Route::get('tamu/mainKeluhan/tambah', 'guesthousecontroller@tampil_tambah_keluhan');
Route::get('tamu/mainKeluhan/hapus/{id_keluhan}', 'guesthousecontroller@actionhapus_keluhan');

// Reservasi
Route::post('reservasi/tambahReservasi/actiontambah_reservasi', 'guesthousecontroller@actiontambah_reservasi');
Route::post('reservasi/actionedit_reservasi', 'guesthousecontroller@actionedit_reservasi');
Route::get('reservasi/Edit/{id_reservasi}', 'guesthousecontroller@tampil_edit_reservasi');
Route::get('reservasi/Hapusact/{id_reservasi}', 'guesthousecontroller@actionhapus_reservasi');
Route::get('reservasi/Edit/{id_reservasi}/cetak', 'guesthousecontroller@actioncetak_reservasi');

// Master Kamar
Route::get('master/Kamar/Edit/{id_kamar}', 'guesthousecontroller@tampil_edit_kamar');
Route::get('master/Kamar/tambah', 'guesthousecontroller@tambahdata_kamar');
Route::get('master/Kamar/Hapusact/{id}', 'guesthousecontroller@actionhapus_kamar');
Route::post('master/Kamar/tambah/actiontambah_kamar', 'guesthousecontroller@actiontambah_kamar');
Route::post('master/Kamar/Edit', 'guesthousecontroller@actionedit_kamar');

// Master TipeKamar
Route::get('master/TipeKamar/Edit/{id_kamar}', 'guesthousecontroller@tampil_edit_tipekamar');
Route::get('master/TipeKamar/tambah', 'guesthousecontroller@tambahdata_tipekamar');
Route::get('master/TipeKamar/Hapusact/{id}', 'guesthousecontroller@actionhapus_tipekamar');
Route::post('master/TipeKamar/tambah/actiontambah_karyawan', 'guesthousecontroller@actiontambah_tipekamar');
Route::post('master/TipeKamar/Edit', 'guesthousecontroller@actionedit_tipekamar');

// Master Karyawan
Route::get('master/Karyawan/Edit/{id_user}', 'guesthousecontroller@tampil_edit_karyawan');
Route::get('master/Karyawan/tambah', 'guesthousecontroller@tambahdata_karyawan');
Route::get('master/Karyawan/Hapusact/{id}', 'guesthousecontroller@actionhapus_karyawan');
Route::post('master/Karyawan/tambah/actiontambah_karyawan', 'guesthousecontroller@actiontambah_karyawan');
Route::post('master/Karyawan/Edit', 'guesthousecontroller@actionedit_karyawan');
