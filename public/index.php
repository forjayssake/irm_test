<?php
ini_set('display_errors', 1);

use Api\Exception\RequestInvalidException;
use Api\Request;
use Api\Router;

include __DIR__ . '/../vendor/autoload.php';

// set up the available routes
$router = new Router();
include __DIR__ . '/../api/config/routes.php';

try {
    $request = new Request($_SERVER);
    $response = $router->dispatch($request);
} catch (RequestInvalidException $e) {
    $response = ['error' => 'An exception occurred'];
}

echo json_encode($response);