<?php

namespace Core;

class Route
{
    private static array $routes = [];

    public static function get(string $urlPattern, mixed $action)
    {
        static::handleRequest('GET', $urlPattern, $action);
    }

    public static function post(string $urlPattern, mixed $action)
    {
        static::handleRequest('POST', $urlPattern, $action);
    }

    public static function put(string $urlPattern, mixed $action)
    {
        static::handleRequest('PUT', $urlPattern, $action);
    }

    public static function delete(string $urlPattern, mixed $action)
    {
        static::handleRequest('DELETE', $urlPattern, $action);
    }

    public static function find(string $url, string $method): mixed
    {
        foreach (static::$routes as $pattern => $methods) {
            if (preg_match($pattern, $url, $matches) && isset($methods[$method])) {
                unset($matches[0]);

                return static::callAction($methods[$method], $matches);
            }
        }

        return Response::notFound();
    }

    private static function callAction($action, $params)
    {
        if (is_callable($action)) {
            return $action(...$params);
        }

        if (is_array($action)) {
            return call_user_func_array([new $action[0](), $action[1]], $params);
        }

        return $action;
    }

    public static function getAllRoutes(): array
    {
        return static::$routes;
    }

    private static function handleRequest(string $method, string $urlPattern, mixed $action): void
    {
        $urlPattern = str_replace('/', '\/', $urlPattern);
        $urlPattern = preg_replace('/\{(.+)\}/', '(.+)', $urlPattern);
        static::$routes["/$urlPattern/"][$method] = $action;
    }
}
