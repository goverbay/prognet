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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
//     Auth::routes(['register' => false]);
//  });

Route::get('/login/admin', 'Admin\Auth\LoginController@showLoginForm');
Route::post('/login/admin', 'Admin\Auth\LoginController@adminLogin');
Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');

Route::get('/admin/notif', 'HomeController@ShowAdminNotification');
Route::get('/admin/mark/{id}', 'HomeController@MarkAdminNotification');
Route::get('/admin/read', 'NotifyController@baca');

Route::get('/admin/home', 'Admin\AdminController@index')->middleware('admin');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegister')->middleware('admin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::get('/admin/edit-profile','Admin\AdminController@editProfile');

Route::get('/admin/kategori_produk', 'Admin\KategoriController@index');
Route::get('/admin/kategori_produk/tambah', 'Admin\KategoriController@tambah_data');
Route::post('/admin/kategori_produk/store', 'Admin\KategoriController@store');
Route::get('/admin/kategori_produk/edit/{id}', 'Admin\KategoriController@edit');
Route::post('/admin/kategori_produk/update', 'Admin\KategoriController@update');
Route::get('/admin/kategori_produk/hapus/{id}', 'Admin\KategoriController@hapus');

Route::get('/admin/kurir', 'Admin\KurirController@index');
Route::get('/admin/kurir/tambah', 'Admin\KurirController@tambah_data');
Route::post('/admin/kurir/store', 'Admin\KurirController@store');
Route::get('/admin/kurir/edit/{id}', 'Admin\KurirController@edit');
Route::post('/admin/kurir/update', 'Admin\KurirController@update');
Route::get('/admin/kurir/hapus/{id}', 'Admin\KurirController@hapus');


Route::get('/admin/produk', 'Admin\ProdukController@index');
Route::get('/admin/produk/tambah', 'Admin\ProdukController@tambah');
Route::post('/admin/produk/store', 'Admin\ProdukController@store');
Route::get('/admin/produk/show/{id}', 'Admin\ProdukController@show');
Route::get('/admin/produk/tambah_kategori/{id}', 'Admin\ProdukController@tambah_kategori');
Route::post('/admin/produk/tambah_kategori', 'Admin\ProdukController@store_kategori');
Route::get('/admin/produk/kategori_produk/hapus/{id}', 'Admin\ProdukController@hapus_kategori');
Route::get('/admin/produk/edit/{id}', 'Admin\ProdukController@edit');
Route::post('/admin/produk/update', 'Admin\ProdukController@update');
Route::get('/admin/produk/tambah_gambar/{id}', 'Admin\ProdukController@tambah_gambar');
Route::post('/admin/produk/tambah_gambar', 'Admin\ProdukController@store_gambar');
Route::get('/admin/produk/gambar/hapus/{id}', 'Admin\ProdukController@hapus_gambar');
Route::get('/admin/produk/hapus/{id}', 'Admin\ProdukController@hapus');
Route::get('/admin/produk/tambah_diskon/{id}', 'Admin\DiscountController@tambah');
Route::post('/admin/produk/tambah_diskon', 'Admin\DiscountController@store');
Route::get('/admin/produk/diskon/edit/{id}', 'Admin\DiscountController@edit');
Route::post('/admin/produk/diskon/edit', 'Admin\DiscountController@update');
Route::get('/admin/produk/diskon/hapus/{id}', 'Admin\DiscountController@hapus');
Route::get('/admin/produk/review/hapus/{id}', 'Admin\ProdukController@hapus_review');
Route::get('/admin/transaksi', 'TransactionController@adminIndex');
Route::post('/admin/transaksi/sort', 'TransactionController@sort');
Route::get('/admin/transaksi/detail/{id}', 'TransactionDetailController@adminIndex');
route::get('/admin/transaksi/detail/{id}/{idnot}', 'TransactionDetailController@adminNotifyIndex');

//Route User
Route::get('/produk/{id}', 'HomeController@show')->middleware('verified');
Route::get('/produk/{id}/{id2}', 'HomeController@NotifyShow')->middleware('verified');
Route::get('/notif', 'HomeController@ShowNotification');
Route::get('/mark/{id}', 'HomeController@MarkNotification');
Route::get('/baca', 'NotifyUser@Read');

Route::post('/tambah_cart', 'CartController@store');
Route::post('/show_categori', 'HomeController@show_kategori');
Route::get('/cart', 'CartController@show');
Route::post('/update_qty', 'CartController@update');
Route::post('/checkout', 'CheckoutController@index');
Route::post('/ongkir', 'CheckoutController@submit');
Route::get('/kota/{id}', 'CheckoutController@getCities');
Route::post('/beli', 'TransactionController@store');
Route::get('/transaksi/{id}', 'TransactionController@index');
Route::get('/transaksi/detail/{id}', 'TransactionDetailController@index');
Route::post('/transaksi/detail/status', 'TransactionDetailController@membatalkanPesanan');
Route::post('/transaksi/detail/proof', 'TransactionDetailController@uploadProof');
Route::post('/transaksi/detail/review', 'ProductReviewController@store');
Route::post('/respon', 'ResponseController@store');
Route::post('/edit/review', 'ProductReviewController@update');
Route::post('/read-notif', 'ProductReviewController@readNotif');
Route::post('/report-bulan', 'TransactionController@filterBulan');
Route::post('/report-tahun', 'TransactionController@filterTahun');
Route::post('/grafik', 'TransactionController@grafik');


