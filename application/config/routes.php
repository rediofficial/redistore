<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['setDefaultNamespace'] = 'Application/Controllers';
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/index'; // Rute untuk halaman login
$route['register'] = 'login/register'; // Rute untuk proses login
$route['masuk'] = 'login/dashboard'; // Rute untuk ke login
$route['beranda'] = 'user/index'; // Rute untuk ke beranda
$route['tentang_kami'] = 'home/tentang_kami'; // Rute untuk ke tentang kami
$route['riwayat_pesanan'] = 'user/riwayat_pesanan'; // Rute untuk ke riwayat pesanan
$route['chat'] = 'user/index'; // Rute untuk ke chat
$route['riwayat_pesanan'] = 'user/riwayat_pesanan'; // Rute untuk ke riwayat pesanan
$route['profile'] = 'user/profile'; // Rute untuk ke profil
$route['ganti_sandi'] = 'user/change_password'; // Rute untuk ke ganti sandi
$route['user/akun_detail'] = 'user/akun_detail';
$route['user/riwayat_pesanan/(:any)'] = 'user/riwayat_pesanan/$1';
$route['home/search'] = 'home/search';

$route['seller/kelola_penjualan'] = 'Seller/kelola_penjualan';
$route['seller/edit_akun/(:num)'] = 'Seller/edit_akun/$1';
$route['seller/hapus_akun/(:num)'] = 'Seller/hapus_akun/$1';
$route['seller'] = 'seller/index'; // Rute untuk seller login
$route['seller/dashboard'] = 'seller/dashboard'; // Rute untuk seller berannda
$route['review/reply'] = 'reply_review/reply';
$route['login/authen'] = 'login/authen';
$route['admin'] = 'admin/index';

$route['admin/review/delete/(:num)'] = 'admin/review/delete_review/$1'; //Tambahkan rute untuk menghapus ulasan di file routes:


