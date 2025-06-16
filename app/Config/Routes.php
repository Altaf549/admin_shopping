<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication routes
$routes->get('/login', 'Auth\Login::index');
$routes->post('/login/authenticate', 'Auth\Login::authenticate');
$routes->get('admin/logout', 'Auth\Login::logout');

// Admin routes

$routes->get('admin/dashboard', 'Admin\Dashboard::index');

// Users routes
$routes->get('admin/users', 'Admin\Users::index');
$routes->get('admin/users/create', 'Admin\Users::create');
$routes->post('admin/users/store', 'Admin\Users::store');
$routes->get('admin/users/edit/(:num)', 'Admin\Users::edit/$1');
$routes->post('admin/users/update/(:num)', 'Admin\Users::update/$1');
$routes->delete('admin/users/delete/(:num)', 'Admin\Users::delete/$1');

// Products routes
$routes->get('admin/products', 'Admin\Products::index');
$routes->get('admin/products/create', 'Admin\Products::create');
$routes->post('admin/products/store', 'Admin\Products::store');
$routes->get('admin/products/edit/(:num)', 'Admin\Products::edit/$1');
$routes->post('admin/products/update/(:num)', 'Admin\Products::update/$1');
$routes->delete('admin/products/delete/(:num)', 'Admin\Products::delete/$1');

// Orders routes
$routes->get('admin/orders', 'Admin\Orders::index');
$routes->get('admin/orders/view/(:num)', 'Admin\Orders::view/$1');
$routes->post('admin/orders/updateStatus/(:num)', 'Admin\Orders::updateStatus/$1');
