<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes 
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login', ['filter' => 'csrf']);
$routes->get('/logout', 'Auth::logout');

$routes->post('/auth/process', 'Auth::process', ['filter' => 'csrf']);

$routes->get('/lihat-semua-pengumuman', 'Home::pengumuman');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Home::dashboard');

    //penduduk
    $routes->get('/penduduk', 'Penduduk::index');
    $routes->group('', ['filter' => 'admin'], function ($routes) {
        $routes->get('/penduduk/create', 'Penduduk::create');
        $routes->post('/penduduk/store', 'Penduduk::store');
        $routes->get('/penduduk/edit/(:num)', 'Penduduk::edit/$1');
        $routes->post('/penduduk/update/(:num)', 'Penduduk::update/$1');
        $routes->get('/penduduk/delete/(:num)', 'Penduduk::delete/$1');
    });

    //users
    $routes->get('/users', 'Users::index');
    $routes->group('', ['filter' => 'admin'], function ($routes) {
        $routes->get('/users/create', 'Users::create');
        $routes->post('/users/store', 'Users::store');
        $routes->get('/users/edit/(:num)', 'Users::edit/$1');
        $routes->post('/users/update/(:num)', 'Users::update/$1');
        $routes->get('/users/delete/(:num)', 'Users::delete/$1');
    });

    $routes->get('/pengumuman', 'Pengumuman::index');
    $routes->group('', ['filter' => 'admin'], function ($routes) {
        $routes->get('/pengumuman/create', 'Pengumuman::create');
        $routes->post('/pengumuman/store', 'Pengumuman::store');
        $routes->get('/pengumuman/edit/(:num)', 'Pengumuman::edit/$1');
        $routes->post('/pengumuman/update/(:num)', 'Pengumuman::update/$1');
        $routes->get('/pengumuman/delete/(:num)', 'Pengumuman::delete/$1');
    });
});

$routes->get('/forbidden', function () {
    return view('errors/html/error_403');
});
