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

$routes->get('/dashboard/admin', 'Dashboard::index', ['filter' => "auth"]);
$routes->get('/dashboard/guru', 'Dashboard::teacher', ['filter' => "auth"]);
$routes->get('/dashboard/siswa', 'Dashboard::student', ['filter' => "auth"]);

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

$routes->get('/kelas', 'StudentClass::index', ['filter' => "auth:$roleAdmin"]);
$routes->get('/kelas/(:num)/semester/(:num)', 'StudentClass::detail/$1/$2', ['filter' => "auth:$roleAdmin"]);
$routes->post('/kelas/siswa/tambah', 'StudentClass::addStudentClass', ['filter' => "auth:$roleAdmin"]);
$routes->delete('/kelas/siswa/(:num)', 'StudentClass::deleteStudentClass/$1', ['filter' => "auth:$roleAdmin"]);

$routes->get('/jadwal-mapel', 'Schedule::index', ['filter' => "auth:$roleAdmin"]);
$routes->get('/jadwal-mapel/tambah', 'Schedule::add', ['filter' => "auth:$roleAdmin"]);
$routes->post('/jadwal-mapel/tambah', 'Schedule::add', ['filter' => "auth:$roleAdmin"]);
$routes->delete('/jadwal-mapel/(:num)', 'Schedule::delete/$1', ['filter' => "auth:$roleAdmin"]);

$routes->get('/pertemuan/(:num)', 'Session::index/$1', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
$routes->get('/pertemuan/detail/(:num)', 'Session::detail/$1', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
$routes->post('/pertemuan/item', 'SessionItem::add', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
$routes->get('/pertemuan/item/download/(:num)', 'SessionItem::download/$1', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
$routes->delete('/pertemuan/item/(:num)', 'SessionItem::delete/$1', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
$routes->post('/pertemuan/siswa/tambah', 'Session::addStudent', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
$routes->post('/pertemuan/item/komen/tambah', 'SessionItem::comment', ['filter' => "auth:$roleAdmin,$roleTeacher"]);
