<?php

use Api\Exception\RequestInvalidException;
use Api\Request;
use Api\Router;

include __DIR__ . '/../vendor/autoload.php';

// set up the available routes
$router = new Router();
include __DIR__ . '/../api/config/routes.php';

try {
    $request = new Request($_SERVER);

    if ($router->hasRoute($request)) {

    } else {
        $response = ['error' => 'not found'];
    }
} catch (RequestInvalidException $e) {
    $response = ['error' => 'An exception occurred'];
}

echo json_encode($response);