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
$routes->get('admin/brahman', 'Admin\Brahman::index');
$routes->post('admin/brahman/toggle-status/(:num)/(:segment)', 'Admin\Brahman::toggleStatus/$1/$2');
$routes->get('admin/user', 'Admin\User::index');
$routes->post('admin/user/toggle-status/(:num)/(:segment)', 'Admin\User::toggleStatus/$1/$2');

// Event routes
$routes->get('admin/event', 'Admin\Event::index');
$routes->post('admin/event/toggle-status/(:num)/(:segment)', 'Admin\Event::toggleStatus/$1/$2');


