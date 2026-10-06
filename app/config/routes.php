<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
| @var object $router
|
*/


// ================================================================
// HOME / USERS
// ================================================================

$router->get('/', 'UsersController::index');

$router->get('/users', 'UsersController::index');


// ================================================================
// STUDENT
// ================================================================

$router->get('/student/profile', 'StudentController::profile')
       ->middleware('student');


// ================================================================
// WEB AUTHENTICATION
// ================================================================

$router->get('auth/login', 'Auth@login');

$router->post('auth/login', 'Auth@login');

$router->get('auth/logout', 'Auth@logout');


// ================================================================
// PRODUCT WEB INTERFACE
// ================================================================

$router->get('product', 'Product@index');

$router->get('product/create', 'Product@create');

$router->post('product/create', 'Product@create');

$router->get('product/edit/{id}', 'Product@edit');

$router->post('product/edit/{id}', 'Product@edit');

$router->get('product/delete/{id}', 'Product@delete');

$router->get('product/view/{id}', 'Product@view');


// ================================================================
// PRODUCT WEB ROUTES USING (:any)
// ================================================================

$router->get('product/edit/(:any)', 'Product@edit');

$router->post('product/edit/(:any)', 'Product@edit');

$router->get('product/delete/(:any)', 'Product@delete');

$router->get('product/view/(:any)', 'Product@view');


// ================================================================
// API CORS PRE-FLIGHT
// ================================================================
//
// React frontend:
// http://localhost:5173
//
// LavaLust API:
// http://127.0.0.1:3000
//
// The browser sends OPTIONS before POST/PUT/PATCH/DELETE.
// These routes handle those OPTIONS requests.
//

$router->options(
    'api/auth/login',
    function () {

        header('Access-Control-Allow-Origin: ' . (in_array($_SERVER['HTTP_ORIGIN'] ?? '', ['http://localhost:5173', 'http://127.0.0.1:5173', 'https://product-frontend-xwhk.onrender.com'], true) ? $_SERVER['HTTP_ORIGIN'] : ''));
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With, X-RateLimit-*');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
        header('Access-Control-Max-Age: 3600');

        http_response_code(204);
        exit;
    }
);


$router->options(
    'api/auth/refresh',
    function () {

        header('Access-Control-Allow-Origin: ' . (in_array($_SERVER['HTTP_ORIGIN'] ?? '', ['http://localhost:5173', 'http://127.0.0.1:5173', 'https://product-frontend-xwhk.onrender.com'], true) ? $_SERVER['HTTP_ORIGIN'] : ''));
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With, X-RateLimit-*');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
        header('Access-Control-Max-Age: 3600');

        http_response_code(204);
        exit;
    }
);


$router->options(
    'api/auth/logout',
    function () {

        header('Access-Control-Allow-Origin: ' . (in_array($_SERVER['HTTP_ORIGIN'] ?? '', ['http://localhost:5173', 'http://127.0.0.1:5173', 'https://product-frontend-xwhk.onrender.com'], true) ? $_SERVER['HTTP_ORIGIN'] : ''));
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With, X-RateLimit-*');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
        header('Access-Control-Max-Age: 3600');

        http_response_code(204);
        exit;
    }
);


// ================================================================
// API AUTHENTICATION
// ================================================================

$router->post(
    'api/auth/login',
    'ApiAuth::login'
);

$router->post(
    'api/auth/refresh',
    'ApiAuth::refresh'
);

$router->post(
    'api/auth/logout',
    'ApiAuth::logout'
);


// ================================================================
// PRODUCT API CORS PRE-FLIGHT
// ================================================================
//
// GET /api/products
// POST /api/products
// GET /api/products/{id}
// PUT /api/products/{id}
// PATCH /api/products/{id}
// DELETE /api/products/{id}
//

$router->options(
    'api/products',
    function () {

        header('Access-Control-Allow-Origin: ' . (in_array($_SERVER['HTTP_ORIGIN'] ?? '', ['http://localhost:5173', 'http://127.0.0.1:5173', 'https://product-frontend-xwhk.onrender.com'], true) ? $_SERVER['HTTP_ORIGIN'] : ''));
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With, X-RateLimit-*');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
        header('Access-Control-Max-Age: 3600');

        http_response_code(204);
        exit;
    }
);


$router->options(
    'api/products/{id}',
    function () {

        header('Access-Control-Allow-Origin: ' . (in_array($_SERVER['HTTP_ORIGIN'] ?? '', ['http://localhost:5173', 'http://127.0.0.1:5173', 'https://product-frontend-xwhk.onrender.com'], true) ? $_SERVER['HTTP_ORIGIN'] : ''));
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With, X-RateLimit-*');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
        header('Access-Control-Max-Age: 3600');

        http_response_code(204);
        exit;
    }
);


// ================================================================
// PRODUCT API
// ================================================================

$router->get(
    'api/products',
    'ProductApi::index'
);

$router->get(
    'api/products/{id}',
    'ProductApi::show'
);

$router->post(
    'api/products',
    'ProductApi::store'
);

$router->put(
    'api/products/{id}',
    'ProductApi::update'
);

$router->patch(
    'api/products/{id}',
    'ProductApi::update'
);

$router->delete(
    'api/products/{id}',
    'ProductApi::delete'
);


// ================================================================
// MIGRATION
// ================================================================

$router->get(
    'create-migration/{migration_class}',
    'MigrationController::create_migration'
);

$router->get(
    'migrate',
    'MigrationController::migrate'
);

$router->get(
    'rollback',
    'MigrationController::rollback'
);

$router->get(
    'rollback-all',
    'MigrationController::rollback_all'
);

$router->get(
    'refresh',
    'MigrationController::refresh'
);

$router->get(
    'status',
    'MigrationController::status'
);
