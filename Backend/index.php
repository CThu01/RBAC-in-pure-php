<?php

require_once "routes/Router.php";

header("Content-Type: application/json");

$router = new Router();

/* USER ROUTES */
$router->get('/api/users', 'UserController@getAllUserApi');
$router->get('/api/users/{id}', 'UserController@getByIdApi');
$router->post('/api/users', 'UserController@createApi');
$router->put('/api/users/{id}', 'UserController@updateUserApi');
$router->delete('/api/users/{id}', 'UserController@deleteUserApi');

/* ROLE ROUTES */
$router->get('/api/roles', 'RoleController@index');
$router->post('/api/roles', 'RoleController@store');
$router->post('/api/roles/{id}/permissions', 'RoleController@assignPermissions');

/* AUTH */
$router->post('/api/login', 'AuthController@login');
$router->post('/api/logout', 'AuthController@logout');



try {
    $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (UserNotFoundException $e) {
    ApiResponse::toJson(
        null,
        "User not found: " . $e->getMessage(),
        404
    );
} catch (DatabaseConnectionException $e) {
    ApiResponse::toJson(
        null,
        "Database connection error: " . $e->getMessage(),
        500
    );
} catch (Exception $e) {
    ApiResponse::toJson(
        null,
        $e->getMessage(),
        500
    );
}
