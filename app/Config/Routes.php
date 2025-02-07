<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('auth', function ($routes) {
    $routes->get('', 'Auth::login');
    $routes->match(['get', 'post'], 'login', 'Auth::login');
    $routes->post('logout', 'Auth::logout');
});
$routes->group('kategori', function ($routes) {
    $routes->get('', 'Kategori::index');
    $routes->post('tambah', 'Kategori::process_tambah');
    $routes->get('ubah/(:num)', 'Kategori::ubah');
});
$routes->group('nasabah', function ($routes) {
    $routes->get('', 'Nasabah::index');
    $routes->match(['get', 'post'], 'tambah', 'Nasabah::tambah');
    $routes->match(['get', 'post'], 'ubah/(:num)', 'Nasabah::ubah');
    $routes->post('hapus/(:num)', 'Nasabah::hapus');
});
$routes->group('teller', function ($routes) {
    $routes->get('', 'Teller::index');
    $routes->match(['get', 'post'], 'tambah', 'Teller::tambah');
    $routes->match(['get', 'post'], 'ubah/(:num)', 'Teller::ubah');
    $routes->post('hapus/(:num)', 'Teller::hapus');
});
$routes->group('admin', function ($routes) {
    $routes->get('', 'admin::index');
    $routes->match(['get', 'post'], 'tambah', 'admin::tambah');
    $routes->match(['get', 'post'], 'ubah/(:num)', 'admin::ubah');
    $routes->post('hapus/(:num)', 'admin::hapus');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
