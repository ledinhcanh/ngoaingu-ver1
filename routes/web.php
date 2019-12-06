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

Route::view('error','errors.403')->name('error');

Route::view('admin/login','admin.pages.login')->name('login.admin');
Route::post('admin/login','TaiKhoanController@loginAdmin')->name('admin.login');
Route::get('admin/logout', 'TaiKhoanController@logoutAdmin')->name('logout.admin');

Route::get('getchuyenmuc', 'AjaxController@getchuyenmuc');
Route::get('getlop', 'AjaxController@getlop');

Route::group(['prefix' => 'admin','middleware' => 'adminMiddleware'], function () {
    Route::get('/','TaiKhoanController@indexadmin')->name('admin');
    Route::get('detail/{id}', 'TaiKhoanController@editdetail')->name('admin.detail');
    Route::post('detail/{id}', 'TaiKhoanController@updatedetail')->name('admin.detail.update');

    Route::resource('muc', 'MucController');
    Route::get('muc/delete/{id}', 'MucController@destroy')->name('muc.destroy');
    Route::resource('chuyenmuc', 'ChuyenMucController');
    Route::get('chuyenmuc/delete/{id}', 'ChuyenMucController@destroy')->name('chuyenmuc.destroy');
    Route::resource('baiviet', 'BaiVietController');
    Route::get('baiviet/delete/{id}', 'BaiVietController@destroy')->name('baiviet.destroy');
    Route::resource('slide', 'SlideController');
    Route::get('slide/delete/{id}', 'SlideController@destroy')->name('slide.destroy');
    Route::resource('taikhoan', 'TaiKhoanController');
    Route::get('taikhoan/delete/{id}', 'TaiKhoanController@destroy')->name('taikhoan.destroy');
    Route::resource('lop', 'LopController');
    Route::resource('sinhvien', 'SinhVienController');
    Route::get('sinhvien/delete/{id}', 'SinhVienController@destroy')->name('sinhvien.destroy');
    Route::resource('giangvien', 'GiangVienController');
    Route::get('giangvien/delete/{id}', 'GiangVienController@destroy')->name('giangvien.destroy');
    Route::resource('trang', 'TrangController');
    Route::get('trang/delete/{id}', 'TrangController@destroy')->name('trang.destroy');
    Route::resource('tailieu', 'TaiLieuController');
    Route::get('tailieu/delete/{id}', 'TaiLieuController@destroy')->name('tailieu.destroy');
    Route::get('baiviet/{action}/{id}', 'BaiVietController@action')->name('baiviet.action');
    Route::resource('baithaoluan', 'ThaoLuanController');
    Route::get('baithaoluan', 'ThaoLuanController@index1')->name('baithaoluan.index');
    Route::get('baithaoluan/delete/{id}', 'ThaoLuanController@destroy')->name('baithaoluan.destroy');
    Route::resource('lienhe', 'LienHeController');
    Route::get('lienhe/delete/{id}', 'LienHeController@destroy')->name('lienhe.destroy');
    Route::resource('lich', 'LichController');
    Route::get('lich/delete/{id}', 'LichController@destroy')->name('lich.destroy');
    Route::resource('lichtuan', 'LichTuanController');
    Route::get('lichtuan/delete/{id}', 'LichTuanController@destroy')->name('lichtuan.destroy');
    Route::resource('ctdaotao', 'HocPhanController');
    Route::get('ctdaotao/delete/{id}', 'HocPhanController@destroy')->name('ctdaotao.destroy');
});
Route::get('/', 'HomeController@index')->name('client.login');
Route::post('/', 'TaiKhoanController@loginclient');
Route::get('logout', 'TaiKhoanController@logoutclient')->name('client.logout');


Route::group(['prefix' => 'don-vi'], function () {
    Route::get('gioi-thieu', 'HomeController@gioithieu');
    Route::get('{slug}', 'TinTucController@bomon');
});
Route::get('tin/{slug}', 'TinTucController@tintuc');
Route::get('tuyen-sinh/{slug}', 'TinTucController@tuyensinh');
Route::get('chuyen-nganh/{slug}', 'TinTucController@chuyennganh');
Route::get('tai-lieu/{slug}', 'TaiLieuController@tailieu');
Route::get('tim-kiem-tai-lieu', 'TaiLieuController@search');
Route::get('tai-ve-tai-lieu/{cat}/{id}/{slug}', 'TaiLieuController@download');
Route::get('tim-kiem-file-tai-lieu/{slug}', 'TaiLieuController@search_by_file_type');
Route::get('lien-he', 'LienHeController@create')->name('lienhe.create');
Route::post('lien-he', 'LienHeController@store')->name('lienhe.store');
Route::group(['prefix' => 'viec-lam'], function () {
    Route::get('/', 'TinTucController@tuyendung');
    Route::get('{slug}', 'TinTucController@cttuyendung');
});
Route::group(['prefix' => 'lich-tuan'], function () {
    Route::get('/', 'TinTucController@lichtuan');
    Route::get('{slug}', 'TinTucController@ctlichtuan');
});
Route::group(['prefix' => 'thao-luan'], function () {
    Route::get('/', 'ThaoLuanController@index')->name('thaoluan.index');
    Route::get('create', 'ThaoLuanController@create')->name('thaoluan.create');
    Route::post('create', 'ThaoLuanController@store')->name('thaoluan.store');
    Route::get('edit/{id}', 'ThaoLuanController@edit')->name('thaoluan.edit');
    Route::post('edit/{id}', 'ThaoLuanController@update')->name('thaoluan.update');
    Route::get('delete/{id}', 'ThaoLuanController@destroyclient')->name('thaoluan.destroy');
    Route::get('bai-dang/{id}', 'ThaoLuanController@detail')->name('thaoluan.detail');
    // Route::get('binhluan/{id}', 'BinhLuanController@edit');
    
    Route::resource('binhluan','BinhLuanController');
    Route::post('binhluan/add/{id}', 'BinhLuanController@postcreate')->name('binhluan.create');
    Route::get('binhluan/delete/{id}', 'BinhLuanController@destroy')->name('binhluan.destroy');
    
    // Route::post('binhluan/{id}', 'BinhLuanController@update')->name('binhluan.update');
});
Route::get('profile/{id}', 'TinTucController@profile')->name('profile.index');
Route::get('thongtin/{id}', 'TinTucController@profile1')->name('profile1.index');
Route::get('profile/edit/{id}', 'TinTucController@editprofile')->name('profile.edit');
// Route::post('profile/edit/{id}', 'TinTucController@updategiangvien')->name('profile.update');
Route::post('profile/edit/{id}', 'SinhVienController@update');
Route::post('profile/edit/{id}', 'GiangVienController@update');
Route::get('changepass/{id}', 'TaiKhoanController@doimatkhau')->name('doimatkhau');
Route::post('changepass/{id}', 'TaiKhoanController@updatematkhau');

Route::get('tim-kiem','TinTucController@timkiem');
Route::get('tim-kiem-bai','ThaoLuanController@timkiem');

Auth::routes(['verify' => true]);

Route::get('lich', 'TinTucController@lichsh');