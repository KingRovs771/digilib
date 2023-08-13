<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Akses Umum
$route['default_controller'] = 'kunjungan';
$route['404_override'] = 'kunjungan';
$route['translate_uri_dashes'] = TRUE;

// Akses Admin
$route['login'] = 'admin/login';
$route['login/auth'] = 'admin/login/auth';
$route['login/logout'] = 'admin/login/logout';

// $route['profil/(:any)'] = 'beranda';
// $route['profil/(:any)/(:any)'] = 'beranda';
// $route['profil/(:any)/(:any)/(:any)'] = 'beranda';
// $route['admin'] = 'admin';
// $route['komentar'] = 'admin/komentar';
// $route['pengaturan'] = 'theme/pengaturan';
//
// $route['statis'] = 'admin/statis';
// $route['statis/simpan'] = 'admin/statis/simpan';
// $route['statis/edit/(:num)'] = 'admin/statis/edit/$1';
// $route['statis/update'] = 'admin/statis/update';

// $route['kategori/(:any)/(:num)'] = 'front/kategori/$1/$2';
