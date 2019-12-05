<?php

namespace Api;

use Api\Exception\RequestInvalidException;

class Router
{
    private $routes = [
        'post' => []
    ];

    /**
     * @throws RequestInvalidException
     */
    private function getRoute(string $type, string $target): array
    {
        if (empty($this->routes[$type][$target])) {
            throw new RequestInvalidException('Route with target: ' . $target . ', is invalid');
        }

        return $this->routes[$type][$target];
    }

    public function dispatch(Request $request): string
    {
        $type = strtolower($request->getType());
        $target = $request->getMethod();

        $route = $this->getRoute($type, $target);
        $response = [];

        $controllerClass = '\\Api\\Controllers\\' . $route['controller'];
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

        if (!is_callable($controller, $action)) {
            throw new RequestInvalidException('Route with target: ' . $target . ', is invalid');
        }

        $this->routes['post'][$route] = [
            'controller' => $controller,
            'action' => $action
        ];
    }
}