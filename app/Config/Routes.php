<?php

use CodeIgniter\Router\RouteCollection;

$roleAdmin = ROLE_ADMIN;
$roleTeacher = ROLE_TEACHER;
$roleStudent = ROLE_STUDENT;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/forbidden', 'Forbidden::index');

$routes->get('/auth/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::index');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => "auth"]);

$routes->get('/guru', 'Teacher::index', ['filter' => "auth:$roleAdmin"]);
$routes->delete('/guru/(:num)', 'Teacher::delete/$1', ['filter' => "auth:$roleAdmin"]);
$routes->get('/guru/tambah', 'Teacher::add', ['filter' => "auth:$roleAdmin"]);
$routes->post('/guru/tambah', 'Teacher::add', ['filter' => "auth:$roleAdmin"]);
$routes->get('/guru/ubah/(:num)', 'Teacher::edit/$1', ['filter' => "auth:$roleAdmin"]);
$routes->post('/guru/ubah/(:num)', 'Teacher::edit/$1', ['filter' => "auth:$roleAdmin"]);

$routes->get('/siswa', 'Student::index', ['filter' => "auth:$roleAdmin"]);
$routes->delete('/siswa/(:num)', 'Student::delete/$1', ['filter' => "auth:$roleAdmin"]);
$routes->get('/siswa/tambah', 'Student::add', ['filter' => "auth:$roleAdmin"]);
$routes->post('/siswa/tambah', 'Student::add', ['filter' => "auth:$roleAdmin"]);
$routes->get('/siswa/ubah/(:num)', 'Student::edit/$1', ['filter' => "auth:$roleAdmin"]);
$routes->post('/siswa/ubah/(:num)', 'Student::edit/$1', ['filter' => "auth:$roleAdmin"]);

$routes->get('/jadwal-mapel', 'Schedule::index', ['filter' => "auth:$roleAdmin"]);
$routes->get('/jadwal-mapel/tambah', 'Schedule::add', ['filter' => "auth:$roleAdmin"]);
$routes->post('/jadwal-mapel/tambah', 'Schedule::add', ['filter' => "auth:$roleAdmin"]);
