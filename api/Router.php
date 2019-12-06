<?php

namespace Api;

use Api\Exception\RequestInvalidException;
use Api\Controllers\TerminalController;

class Router
{
    private $routes = [
        'POST' => []
    ];

    /**
     * @throws RequestInvalidException
     */
    private function getRoute(string $type, string $target): array
    {
        if (!in_array($type, Request::$allowedMethods) || empty($this->routes[$type][$target])) {
            throw new RequestInvalidException('Route with target: ' . $target . ', is invalid');
        }

        return $this->routes[$type][$target];
    }

    public function dispatch(Request $request): array
    {
        $type = $request->getType();
        $target = $request->getMethod();

        $route = $this->getRoute($type, $target);

        $controllerClass = $route['controller'];
        $action = $route['action'];
        $controller = new $controllerClass();

        return $controller->$action($request->getBody());
    }

    /**
     * create a new post route
     * @throws RequestInvalidException
     */
    public function post(string $route, string $target): void
    {
        [$controller, $action] = explode('@', $target);

        $controller = '\\Api\\Controllers\\' . $controller;
        if (!method_exists($controller, $action)) {
            throw new RequestInvalidException('Route with target: ' . $target . ', is invalid');
        }

        $this->routes[Request::TYPE_POST][$route] = [
            'controller' => $controller,
            'action' => $action
        ];
    }
}