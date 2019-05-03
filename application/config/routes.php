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
//$route['img'] = 'welcome/combineImage';

//$route['barang'] = 'myController';

// Authentications
$route['auth/login']						['GET']  = 'auth/login';
$route['auth/login']						['POST'] = 'auth/login';
$route['auth/logout']						['GET']  = 'auth/logout';

$route['kalab/home']						['GET']  = 'Welcome';
$route['home']                              ['GET'] = 'Welcome';

// Profile
$route['profile']							['GET']  = 'Profile';
$route['profile/update']					['POST'] = 'Profile/update';

// Kalab routes

$route['kalab/users']							['GET']  = 'kalab/Users/index';
$route['kalab/users/create']					['GET']  = 'kalab/Users/create';
$route['kalab/users/store']						['POST'] = 'kalab/Users/store';
$route['kalab/users/edit/(:num)']				['GET']  = 'kalab/Users/edit/$1';
$route['kalab/users/update/(:num)']				['POST'] = 'kalab/Users/update/$1';
$route['kalab/users/delete/(:num)']				['POST'] = 'kalab/Users/delete/$1';

$route['kalab/aset']                              ['GET']  = 'kalab/aset';
$route['kalab/aset/(:num)']                       ['GET']  = 'kalab/aset/view/$1';
$route['kalab/aset/create']                       ['GET'] = 'kalab/aset/create';
$route['kalab/aset/store']                        ['POST'] = 'kalab/aset/store';
$route['kalab/aset/edit/(:num)']                  ['GET'] = 'kalab/aset/edit/$1';
$route['kalab/aset/update/(:num)']                ['POST'] = 'kalab/aset/update/$1';
$route['kalab/aset/delete/(:num)']                ['POST'] = 'kalab/aset/delete/$1';
$route['kalab/aset/upload']                       ['POST'] = 'kalab/aset/upload';
$route['kalab/aset/download']                     ['GET'] = 'kalab/aset/download';
$route['kalab/aset/downloadImage/(:num)']         ['GET']  = 'kalab/aset/download_image/$1';
$route['kalab/aset/downloadTemp']                 ['GET']  = 'kalab/aset/download_template';
$route['kalab/aset/download_pembelian']           ['GET']  = 'kalab/aset/download/pembelian';
$route['kalab/aset/upload_update']                ['POST'] = 'kalab/aset/upload/update';

$route['kalab/rka']                               ['GET'] = 'kalab/rka';
$route['kalab/rka/create']                        ['GET'] = 'kalab/rka/create';
$route['kalab/rka/create']                        ['POST'] = 'kalab/rka/create';
$route['kalab/rka/store']                         ['POST'] = 'kalab/rka/store';
$route['kalab/rka/edit/(:num)']                   ['GET'] = 'kalab/rka/edit/$1';
//$route['kalab/rka/editItem/(:num)']              ['POST'] = 'kalab/rka/editItem/$1';
$route['kalab/rka/update/(:num)']                 ['POST'] = 'kalab/rka/update/$1';
$route['kalab/rka/delete/(:num)']                 ['POST'] = 'kalab/rka/delete/$1';

// Input Admin / special admin routes
$route['admin/aset']                              ['GET']  = 'kalab/aset';
$route['admin/aset/(:num)']                       ['GET']  = 'kalab/aset/view/$1';
$route['admin/aset/create']                       ['GET'] = 'kalab/aset/create';
$route['admin/aset/store']                        ['POST'] = 'kalab/aset/store';
$route['admin/aset/edit/(:num)']                  ['GET'] = 'kalab/aset/edit/$1';
$route['admin/aset/update/(:num)']                ['POST'] = 'kalab/aset/update/$1';
$route['admin/aset/delete/(:num)']                ['POST'] = 'kalab/aset/delete/$1';
$route['admin/aset/upload']                       ['POST'] = 'kalab/aset/upload';
$route['admin/aset/download']                     ['GET'] = 'kalab/aset/download';
$route['admin/aset/downloadImage/(:num)']         ['GET']  = 'kalab/aset/download_image/$1';
$route['admin/aset/downloadTemp']                 ['GET']  = 'kalab/aset/download_template';
$route['admin/aset/download_pembelian']           ['GET']  = 'kalab/aset/download/pembelian';
$route['admin/aset/upload_update']                ['POST'] = 'kalab/aset/upload/update';

// Admin routes
//$route['ruangan']                                  ['GET'] = 'admin/ruangan';
//$route['kategori']                                 ['GET'] = 'admin/kategori';
//$route['kategori_khusus']                          ['GET'] = 'admin/kategori_khusus';

$route['aset']                              ['GET']  = 'admin/aset';
$route['aset/(:num)']                       ['GET']  = 'admin/aset/view/$1';
$route['aset/download']                     ['GET'] = 'admin/aset/download';
$route['aset/downloadImage/(:num)']         ['GET']  = 'admin/aset/download_image/$1';

// Kalab and Admin routes
$route['ruangan']                           ['GET'] = 'ruangan';
$route['ruangan/store']                     ['POST'] = 'ruangan/store';
$route['ruangan/edit/(:num)']               ['GET'] = 'ruangan/edit/$1';
$route['ruangan/update/(:num)']             ['POST'] = 'ruangan/update/$1';
$route['ruangan/delete/(:num)']             ['POST'] = 'ruangan/delete/$1';

$route['kategori']                           ['GET'] = 'kategori';
$route['kategori/store']                     ['POST'] = 'kategori/store';
$route['kategori/edit/(:num)']               ['GET'] = 'kategori/edit/$1';
$route['kategori/update/(:num)']             ['POST'] = 'kategori/update/$1';
$route['kategori/delete/(:num)']             ['POST'] = 'kategori/delete/$1';

$route['kategori_khusus']                    ['GET'] = 'kategori_khusus';
$route['kategori_khusus/store']              ['POST'] = 'kategori_khusus/store';
$route['kategori_khusus/edit/(:num)']        ['GET'] = 'kategori_khusus/edit/$1';
$route['kategori_khusus/update/(:num)']      ['POST'] = 'kategori_khusus/update/$1';
$route['kategori_khusus/delete/(:num)']      ['POST'] = 'kategori_khusus/delete/$1';

$route['stok']                              ['GET']  = 'stok';
$route['stok/(:num)']                       ['GET']  = 'stok/view/$1';
$route['stok/create']                       ['GET'] = 'stok/create';
$route['stok/store']                        ['POST'] = 'stok/store';
$route['stok/edit/(:num)']                  ['GET'] = 'stok/edit/$1';
$route['stok/update/(:num)']                ['POST'] = 'stok/update/$1';
$route['stok/delete/(:num)']                ['POST'] = 'stok/delete/$1';
$route['stok/download']                     ['GET'] = 'stok/download';

$route['mutasi']                              ['GET']  = 'mutasi';
$route['mutasi/store']                        ['POST'] = 'mutasi/store';
$route['mutasi/edit/(:num)']                  ['GET'] = 'mutasi/edit/$1';
$route['mutasi/update/(:num)']                ['POST'] = 'mutasi/update/$1';
$route['mutasi/delete/(:num)']                ['POST'] = 'mutasi/delete/$1';

$route['perbaikan']                              ['GET']  = 'perbaikan';
$route['perbaikan/(:num)']                       ['GET']  = 'perbaikan/index/$1';
$route['perbaikan/create']                       ['GET'] = 'perbaikan/create';
$route['perbaikan/store']                        ['POST'] = 'perbaikan/store';
$route['perbaikan/edit/(:num)']                  ['GET'] = 'perbaikan/edit/$1';
$route['perbaikan/update/(:num)']                ['POST'] = 'perbaikan/update/$1';
$route['perbaikan/delete/(:num)']                ['POST'] = 'perbaikan/delete/$1';
$route['perbaikan/downloadSurat/(:num)']         ['GET']  = 'perbaikan/download_surat/$1';

$route['spesifikasi']                              ['GET']  = 'spesifikasi';
$route['spesifikasi/create']                       ['GET']  = 'spesifikasi/create';
$route['spesifikasi/store']                        ['POST'] = 'spesifikasi/store';
$route['spesifikasi/edit/(:num)']                  ['GET'] = 'spesifikasi/edit/$1';
$route['spesifikasi/update/(:num)']                ['POST'] = 'spesifikasi/update/$1';
$route['spesifikasi/delete/(:num)']                ['POST'] = 'spesifikasi/delete/$1';

$route['rekapitulasi']                              ['GET']  = 'welcome/rekapitulasi';

$route['barcode']                                   ['GET']  = 'barcode';
$route['barcode/imgbarcode/(:any)']                 ['GET']  = 'barcode/getBarcode/$1';
$route['barcode/imgbarcode64/(:any)']               ['GET']  = 'barcode/getBarcodeBase64/$1';
$route['barcode/imgqrcode/(:any)']                  ['GET']  = 'barcode/getQRCode/$1';
$route['barcode/imgqrcode64/(:any)']                ['GET']  = 'barcode/getQRCodeBase64/$1';
$route['barcode/create_many']                       ['POST']  = 'barcode/create_many';
$route['barcode/create_from_excel']                 ['POST']  = 'barcode/create_from_excel';
$route['barcode/create']                            ['POST']  = 'barcode/create';
$route['barcode/downloadAssets']                    ['GET']  = 'barcode/download_assets';

$route['permintaan']                                ['GET'] = 'permintaan';
$route['permintaan/store']                          ['POST'] = 'permintaan/store';
$route['permintaan/delete/(:num)']                  ['POST'] = 'permintaan/delete/$1';
$route['permintaan/mark_read/(:num)']               ['GET'] = 'permintaan/mark_read/$1';

$route['laporan/ketersediaan']                      ['GET'] = 'laporan/laporan_ketersediaan';
$route['laporan/stock_opname']                      ['GET'] = 'laporan/stock_opname';    
$route['laporan/kerusakan']                         ['GET'] = 'laporan/laporan_kerusakan';    
$route['laporan/aset_BTI']                          ['GET'] = 'laporan/laporan_aset_di_BTI';

// route for public (api)
$route['search_api']                              ['GET'] = 'search_api/search_computer';
$route['stock_opname_api']                        ['GET'] = 'stock_opname_api/set_exist';

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
