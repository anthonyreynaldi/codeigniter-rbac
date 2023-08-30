<?php

namespace Config;

use App\Controllers\Kelompok\Kelompok;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

# Jangan diubah yang ini!
$routes->addPlaceholder('nrp', '[[:alpha:]][0-9]{8}');

$routes->get('/', 'Home::index');

//Don't forget to apply the auth filter to active the RBAC checking
//You can use route normally but you must register page that use the GET method for transfering data in its url
$routes->group("/panitia", ['filter' => 'auth'], function($routes){
    $routes->get('/', 'panitia\Home::index');

    $routes->group("rbac", function ($routes) {
        $routes->get("/", "RBAC\AssignRole::index");
        $routes->get("role", "RBAC\AssignRole::role");
        $routes->get("role/(:alphanum)", "RBAC\AssignRole::getRole/$1");
        $routes->post("role/(:alphanum)", "RBAC\AssignRole::setRole/$1");
        $routes->delete("role/(:alphanum)", "RBAC\AssignRole::delRole/$1");

        $routes->get("route", "RBAC\AssignRoute::route");
        $routes->get("route/(:num)", "RBAC\AssignRoute::getRoute/$1");
        $routes->post("route/(:num)", "RBAC\AssignRoute::setRoute/$1");
        $routes->delete("route/(:num)", "RBAC\AssignRoute::delRoute/$1");


        $routes->get("addRole", "RBAC\Role::index");
        $routes->post("addRole", "RBAC\Role::add");
        $routes->put("addRole/(:num)", "RBAC\Role::update/$1");
        $routes->delete("addRole/(:num)", "RBAC\Role::delete/$1");

        $routes->get("addRoute", "RBAC\Route::index");
        $routes->post("addRoute", "RBAC\Route::add");
        $routes->put("addRoute/(:num)", "RBAC\Route::update/$1");
        $routes->delete("addRoute/(:num)", "RBAC\Route::delete/$1");
    });

});

$routes->get('assets/(.*)', 'Assets::index');
$routes->get('uploads/(.*)', 'Uploads::index');


# Buat routes kyk biasanya, dibawah!

// $routes->match(['get','post'], 'games/rotasi', 'Rotasi\Rotasi::view');
// $routes->match(['get','post'], 'panitia/games/rotasi', 'Rotasi\Rotasi::view');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
