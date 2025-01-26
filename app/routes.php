<?php

use App\Core\Router;

$router = new Router();

$router->get('/vehicule/add', 'VehiculeController@create');
$router->post('/vehicule/store', 'VehiculeController@store');
$router->get('/vehicule/success', 'VehiculeController@success');

return $router;
