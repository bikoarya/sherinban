<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
// link router
$route['login/sharin'] = 'Auth/Login';
$route['keluar/sharin'] = 'Auth/Keluar';

//retur pembelian
$route['returpembelian']                    = 'retur/Pembelian';
$route['returpembelian/table']              = 'retur/Pembelian/table';
$route['returpembelian/copy/(:any)']        = 'retur/Pembelian/pindahtext/$1';
$route['returpembelian/tambah']             = 'retur/Pembelian/viewtambah';
$route['returpembelian/store']              = 'retur/Pembelian/store';
$route['returpembelian/edit/(:any)']        = 'retur/Pembelian/edit/$1';
$route['returpembelian/update/(:any)']      = 'retur/Pembelian/up/$1';
$route['returpembelian/remove/(:any)']      = 'retur/Pembelian/hapus/$1';

// laporan pembelian
$route['laporanpembelian']                  = 'retur/Pembelian/laporanpembelian';
$route['laporanpembelian/getdata']          = 'retur/Pembelian/lap_get_data';
$route['laporanpembelian/cetak']            = 'retur/Pembelian/cetakdata';



$route['returpengembalian']                 = 'retur/Pengembalian';
$route['returpengembalian/table']           = 'retur/Pengembalian/table';
$route['returpengembalian/searchnota']      = 'retur/Pengembalian/searchnota';
$route['returpengembalian/copy/(:any)']     = 'retur/Pengembalian/pindahtext/$1';
$route['returpengembalian/tambah']          = 'retur/Pengembalian/viewtambah';
$route['returpengembalian/store']           = 'retur/Pengembalian/store';
$route['returpengembalian/edit/(:any)']     = 'retur/Pengembalian/edit/$1';
$route['returpengembalian/update/(:any)']   = 'retur/Pengembalian/up/$1';
$route['returpengembalian/remove/(:any)']   = 'retur/Pengembalian/hapus/$1';

// laporan pengembalian
$route['lapreturpengembalian']                 = 'retur/Pengembalian/laporanpengembalian';
$route['lapreturpengembalian/getdata']         = 'retur/Pengembalian/lap_get_data';
$route['lapreturpengembalian/cetak']           = 'retur/Pengembalian/cetakdata';

// view data pembelian
$route['viewpembelian']                          = 'Gudang/Pembelian/viewpembelian';
$route['viewdatapembelian']                      = 'Gudang/Pembelian/viewdata';
$route['hapuspembelian']                         = 'Gudang/Pembelian/hapusdatapembelian';


$route['laporanlabarugi']                        = 'Laporan/Laplabarugi';
$route['laporanlabarugi/datalabarugi']           = 'Laporan/Laplabarugi/vlabarugi';

$route['default_controller'] = 'Auth/Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
