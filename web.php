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
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/demo', 'HomeController@demo');
Route::get('/admin', 'adminController@admin')->name('admin');
Route::get('/thong-tin', 'thongtinController@thongtin')->name('thongtin');
Route::get('/sinh-vien', 'sinhvienController@sinhvien')->name('sinhvien');
Route::get('/nhan-vien', 'nhanvienController@nhanvien')->name('nhanvien');
    //them nhan vien
    Route::get("nhan-vien/create","nhanvienController@NVCreate");
    Route::post("nhan-vien/create","nhanvienController@NVSave");
    //sửa nhân viên
    Route::get("nhan-vien/edit","nhanvienController@NVEdit");
    Route::post("nhan-vien/edit","nhanvienController@NVUpdate");
    //Xóa nhân viên
Route::get("nhan-vien/delete/{teacher_id}","nhanvienController@NVDelete");
Route::get('/lop', 'lopController@lop')->name('lop');
Route::get('/mon-hoc', 'monhocController@monhoc')->name('monhoc');

