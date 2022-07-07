<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/halaman-utama', 'HomeController@index')->name('home');
Route::get('/permohonan', 'HomeController@permohonan')->name('permohonan');
Route::get('/tetapan', 'HomeController@tetapan')->name('tetapan');
Route::get('/pengguna', 'HomeController@pengguna')->name('pengguna');
Route::get('/pengguna-baru', 'HomeController@penggunaBaru')->name('pengguna-baru');
Route::get('/permohonan-baru', 'HomeController@permohonanbaru')->name('permohonan.baru');
Route::get('/permohonan-kemaskini/{id}', 'HomeController@permohonankemaskini')->name('permohonan.kemaskini');
Route::get('/permohonan-butiran/{id}', 'HomeController@permohonanbutiran')->name('permohonan.butiran');
Route::get('/permohonan-padam/{id}', 'HomeController@permohonanpadam')->name('permohonan.padam');
Route::get('/laporan-tindakan', 'HomeController@laporanTindakan')->name('laporan.tindakan');
Route::get('/laporan-permohonan', 'HomeController@laporanPermohonan')->name('laporan.permohonan');


Route::POST('/simpan-permohonan-baru', 'HomeController@simpanPermohonanBaru')->name('simpan-permohonan-baru');
Route::POST('/kemaskini-permohonan/{id}', 'HomeController@kemaskiniPermohonan')->name('kemaskini-permohonan');
Route::POST('/kemaskini-status-jawatan', 'HomeController@kemaskiniStatusJawatan')->name('kemaskini-status-jawatan');
Route::POST('/kemaskini-status-tindakan-jawatan', 'HomeController@kemaskiniStatusTindakanJawatan')->name('kemaskini-status-tindakan-jawatan');
Route::POST('/kemaskini-maklumat-diri', 'HomeController@kemaskiniMaklumatDiri')->name('kemaskini-maklumat-diri');
Route::POST('/kemaskini-pengguna', 'HomeController@kemaskiniPengguna')->name('kemaskini-pengguna');
Route::POST('/tambah-pengguna', 'HomeController@tambahPengguna')->name('tambah-pengguna');



Route::prefix('volt')->group(function () {
    Route::get('/', 'voltController@index')->name('volt');
    Route::get('/dashboard', 'voltController@dashboard')->name('volt.dashboard');
    Route::get('/setting', 'voltController@setting')->name('volt.setting');
    Route::get('/transactions', 'voltController@transactions')->name('volt.transactions');
    Route::get('/upgrade-to-pro', 'voltController@upgradepro')->name('volt.upgrade-to-pro');
    Route::get('/tables', 'voltController@tables')->name('volt.tables');
    
    Route::prefix('extras')->group(function () {
        Route::get('/sign-in', 'voltController@signIn')->name('volt.extras.sign-in');
        Route::get('/sign-up', 'voltController@signUp')->name('volt.extras.sign-up');
        Route::get('/forgot-password', 'voltController@forgotPassword')->name('volt.extras.forgot-password');
        Route::get('/reset-password', 'voltController@resetPassword')->name('volt.extras.reset-password');
        Route::get('/lock', 'voltController@lock')->name('volt.extras.lock');
        Route::get('/404', 'voltController@error1')->name('volt.extras.404');
        Route::get('/505', 'voltController@error2')->name('volt.extras.505');

    });
    Route::prefix('components')->group(function () {
        Route::get('/buttons', 'voltController@buttons')->name('volt.components.buttons');
        Route::get('/forms', 'voltController@forms')->name('volt.components.forms');
        Route::get('/modals', 'voltController@modals')->name('volt.components.modals');
        Route::get('/notifications', 'voltController@notifications')->name('volt.components.notifications');
        Route::get('/typography', 'voltController@typography')->name('volt.components.typography');
    });
});