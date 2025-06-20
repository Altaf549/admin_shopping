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

//Brahman routes
$routes->get('admin/brahman', 'Admin\Brahman::index');
$routes->post('admin/brahman/toggle-status/(:num)/(:segment)', 'Admin\Brahman::toggleStatus/$1/$2');

//User routes
$routes->get('admin/user', 'Admin\User::index');
$routes->post('admin/user/toggle-status/(:num)/(:segment)', 'Admin\User::toggleStatus/$1/$2');

// Event routes
$routes->get('admin/event', 'Admin\Event::index');
$routes->post('admin/event/toggle-status/(:num)/(:segment)', 'Admin\Event::toggleStatus/$1/$2');
$routes->post('admin/event/create', 'Admin\Event::create');
$routes->post('admin/event/update', 'Admin\Event::update');
$routes->get('admin/event/edit/(:num)', 'Admin\Event::edit/$1');

// Banner routes
$routes->get('admin/banner', 'Admin\Banner::index');
$routes->post('admin/banner/toggle-status/(:num)/(:segment)', 'Admin\Banner::toggleStatus/$1/$2');
$routes->post('admin/banner/create', 'Admin\Banner::create');
$routes->post('admin/banner/update', 'Admin\Banner::update');
$routes->get('admin/banner/edit/(:num)', 'Admin\Banner::edit/$1');

// About Us routes
$routes->get('admin/about-us', 'Admin\AboutUs::index');
$routes->post('admin/about-us/save', 'Admin\AboutUs::save');

// Terms & Conditions routes
$routes->get('admin/terms-condition', 'Admin\TermsCondition::index');
$routes->post('admin/terms-condition/save', 'Admin\TermsCondition::save');

// Privacy Policy routes
$routes->get('admin/privacy-policy', 'Admin\PrivacyPolicy::index');
$routes->post('admin/privacy-policy/save', 'Admin\PrivacyPolicy::save');

// API routes
$routes->post('api/login', 'Api\ApiController::login');
$routes->post('api/admin/login', 'Api\ApiController::adminLogin');
$routes->get('api/brahmans', 'Api\ApiController::getActiveBrahmans');
$routes->get('api/events', 'Api\ApiController::getActiveEvents');
$routes->get('api/pujas', 'Api\ApiController::getActivePujas');
$routes->post('api/user/register', 'Api\ApiController::register');
$routes->post('api/admin/register', 'Api\ApiController::registerAdmin');
$routes->get('api/banners', 'Api\ApiController::getActiveBanners');