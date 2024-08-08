<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return redirect()->route('login');
});

$routes->get('/check', 'Home::tester');

$routes->get('/dashboard', 'Home::index');
$routes->resource('auth-groups', ['controller' => 'AuthGroupController']);
$routes->resource('auth-permissions', ['controller' => 'AuthPermissionController']);
$routes->resource('users', ['controller' => 'UserController']);
