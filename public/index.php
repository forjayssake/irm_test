<?php

use \Api\Router;
use \Api\Request;

include __DIR__ . '/../vendor/autoload.php';

$router = new Router();
require __DIR__ . '/../api/config/routes.php';

$request = new Request($_SERVER);

$response = [];
if ($router->hasRoute($request)) {
    // call the allowed controller method

} else {
    // route not found error

}

echo $response;