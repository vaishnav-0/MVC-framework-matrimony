<?php
namespace Core;

class Router
{
    protected static $routes = [
        'GET' => [],
        'POST' => [],
        'DELETE' => [],
        'PATCH' => []
    ];
    
    
    protected static function get($pattern,array $handler) {
        self::$routes['GET'][$pattern] = $handler;
    }
    protected static function post($pattern, callable $handler) {
        self::$routes['POST'][$pattern] = $handler;
    }
    protected static function patch($pattern, callable $handler) {
        self::$routes['PATCH'][$pattern] = $handler;
    }
    protected static function delete($pattern, callable $handler) {
        self::$routes['DELETE'][$pattern] = $handler;
    }
    
    public function route(Request $request) {
        $method = $request->getMethod();
        if (!isset(self::$routes[$method])) {
            return false;
        }


        $path = $request->getPath();
        foreach (self::$routes[$method] as $pattern => $handler) {
            if ($pattern === $path) {
                return $handler;
            }
        }

        return false;
    }
}