<?php

namespace Config;

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
$routes->get('/', 'Home::index', ["filter" => "auth"]);
$routes->get('dashboard', 'Dashboard::index', ["filter" => "auth"]);
$routes->get('logout', 'Login::logout', ["filter" => "auth"]);
$routes->group('project', ["filter" => "auth"] ,  function ($routes) {
    $routes->get('/', 'Project::index');
    $routes->get('list_budget', 'Project::list_budget');
    $routes->get('budget_detail/(:num)', 'Project::budget_detail/$1');
    $routes->get('client', 'Project::client');
    $routes->post('client_update', 'Project::client_update');
    $routes->post('client_save', 'Project::client_save');
    $routes->get('client_delete/(:num)', 'Project::client_delete/$1');
    $routes->get('finished', 'Project::project_finished');
    $routes->get('search', 'Project::search');
    $routes->get('project_edit/(:num)', 'Project::project_edit/$1');
    $routes->get('project_finish/(:num)', 'Project::project_finish/$1');
    $routes->get('project_delete/(:num)', 'Project::project_delete/$1');
    $routes->post('update_team', 'Project::update_team');
    $routes->post('update_project', 'Project::update_project');
    $routes->post('update_budget', 'Project::update_budget');
    $routes->post('project_add_amount', 'Project::project_add_amount');
    $routes->post('file_save', 'Project::file_save');
    $routes->post('project_save', 'Project::project_save');
    $routes->get('project_detail/(:num)', 'Project::project_detail/$1');
    $routes->post('task_save', 'Project::task_save');
    $routes->get('project_task/(:num)', 'Project::project_task/$1');
    $routes->post('project_timeline_save', 'Project::project_timeline_save');
    $routes->post('task_update', 'Project::task_update');
    $routes->get('task_delete/(:num)', 'Project::task_delete/$1');
});
$routes->group('user', ["filter" => "auth"] ,  function ($routes) {
    $routes->get('list_user/(:any)', 'User::index/$1');
    $routes->get('change_password', 'User::change_password');
    $routes->post('change_password_save', 'User::change_password_save');
    $routes->get('search', 'User::search');
    $routes->post('register_save', 'User::register_save');
    $routes->post('register_update', 'User::register_update');
    $routes->post('register_cpas', 'User::register_cpas');
    $routes->get('register_delete/(:num)', 'User::register_delete/$1');

});
$routes->group('report', ["filter" => "auth"] ,  function ($routes) {
    $routes->get('/', 'Report::index');
    $routes->get('generate_pdf/(:num)', 'Report::generate_pdf/$1');
});
$routes->group('notification', ["filter" => "auth"] ,  function ($routes) {
    $routes->get('/', 'Notification::index');
});
$routes->group('login', ["filter" => "noauth"] ,  function ($routes) {
    $routes->get('/', 'Login::index');
    $routes->post('process', 'Login::process');
});

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
