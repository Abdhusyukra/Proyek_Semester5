<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Halaman Publik
$routes->get('/', 'Home::index');

// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::processLogin');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/setup-admin', 'Auth::setup');
// Group Admin (Diproteksi Filter)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    
    // Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // CRUD Produk
    $routes->get('produk', 'Produk::index');
    $routes->get('produk/tambah', 'Produk::create');
    $routes->post('produk/simpan', 'Produk::store');
    $routes->get('produk/edit/(:num)', 'Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Produk::update/$1');
    $routes->get('produk/hapus/(:num)', 'Produk::delete/$1');

    // CRUD Kategori
    $routes->get('kategori', 'Kategori::index');
    $routes->post('kategori/simpan', 'Kategori::store');
    $routes->get('kategori/hapus/(:num)', 'Kategori::hapus/$1');

    // Stok Barang
    $routes->get('stok', 'Stok::index');
    $routes->post('stok/masuk', 'Stok::masuk');
    $routes->post('stok/keluar', 'Stok::keluar');

    // Laporan
    $routes->get('laporan', 'Laporan::index');
    $routes->post('laporan/filter', 'Laporan::filter');
});