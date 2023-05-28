<?php

namespace Config;

$routes = Services::routes();
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->get('/', 'Home::index');

$routes->post("/login", "LoginController::index");
$routes->group("users", static function ($routes) {
    $routes->post("register", "UserController::register_user");
    $routes->post("update", "UserController::update_user", ['filter' => 'authFilter']);
    $routes->get("all", "UserController::get_all_users", ['filter' => 'authFilter']);
    $routes->get("user", "UserController::get_user_by_id", ['filter' => 'authFilter']);
    $routes->post("delete", "UserController::delete_user_by_id", ['filter' => 'authFilter']);
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
