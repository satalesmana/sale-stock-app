<?php

namespace Config;

use App\Controllers\KategoriController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * ----->----------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

// $routes->get('/kategori', 'KategoriController::index');
// $routes->post('/kategori', 'KategoriController::store');
// $routes->add('/kategori/(:segment)', 'KategoriController::destroy/$1');
// $routes->add('/kategori/(:segment)/edit', 'KategoriController::show/$1');
// $routes->add('/kategori/(:segment)/update', 'KategoriController::update/$1');

// $routes->get('/produk', 'Produkcontorller::index');
// $routes->get('/api/produk', 'Produkcontorller::getData');
// $routes->post('/api/produk/add', 'Produkcontorller::store');
// $routes->add('/api/produk/(:segment)', 'Produkcontorller::destroy/$1');
// $routes->add('/api/produk/(:segment)/edit', 'Produkcontorller::show/$1');
// $routes->add('/api/produk/(:segment)/update', 'Produkcontorller::update/$1');

// $routes->get('/api/getcmb-produk', 'KategoriController::cmbKategori');

$routes->group('', [ 'namespace' => 'App\Controllers'], function($routes){
	
	$routes->get('/', 'Home::index');
	$routes->get('/produk', 'Produkcontorller::index');
	$routes->get('/kategori', 'KategoriController::index');
	
	$routes->get('/login', 'LoginController::index');

});

$routes->group('auth', ['namespace' => 'App\Controllers'], function($routes)
{
    $routes->post('register', 'LoginController::register');
    $routes->post('login', 'LoginController::login');

});

$routes->group('api', ['filter'=>'auth', 'namespace' => 'App\Controllers'], function($routes){
	$routes->resource('produk',['controller' =>'Produkcontorller', 'except' => 'new,edit']);
	$routes->resource('kategori',['controller' =>'KategoriController', 'except' => 'new,edit']);

	$routes->get('getcmb-produk', 'KategoriController::cmbKategori');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
