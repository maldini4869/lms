<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/auth/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::index');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/guru', 'Teacher::index');

$routes->get('/siswa', 'Student::index');
