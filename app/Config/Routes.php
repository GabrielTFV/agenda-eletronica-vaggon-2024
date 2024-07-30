<?php

namespace Config;

use App\Controllers\Auth;
use CodeIgniter\Config\BaseConfig;

$routes = Services::routes();

// Carrega o sistema de rotas
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Define as rotas
$routes->get('/', 'Auth::login');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/loginCheck', 'Auth::loginCheck');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/registerSave', 'Auth::registerSave');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/dashboard', 'Activity::dashboard');
$routes->get('/activity/create', 'Activity::create');
$routes->post('/activity/store', 'Activity::store');
$routes->get('/activity/edit/(:num)', 'Activity::edit/$1');
$routes->post('/activity/update/(:num)', 'Activity::update/$1');
$routes->get('/activity/delete/(:num)', 'Activity::delete/$1');
$routes->get('/activity/getUserActivities', 'Activity::getUserActivities');
$routes->get('/activity/edit/(:num)', 'Activity::edit/$1');
$routes->post('/activity/update/(:num)', 'Activity::update/$1');
$routes->get('/activity/delete/(:num)', 'Activity::delete/$1');
$routes->post('/activities/delete/(:num)', 'Auth::deleteActivity/$1');

