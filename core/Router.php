<?php
namespace Core;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => [],
        'DELETE' => [],
        'PATCH' => []
    ];
    
    
    public function get($pattern,array $handler) {
        $this->routes['GET'][$pattern] = $handler;
    }
    public function post($pattern, array $handler) {
        $this->routes['POST'][$pattern] = $handler;
    }
    public function patch($pattern, array $handler) {
        $this->routes['PATCH'][$pattern] = $handler;
    }
    public function delete($pattern, array $handler) {
        $this->routes['DELETE'][$pattern] = $handler;
    }
    public function route(Request $request) {
        $method = $request->getMethod();
        if (!isset($this->routes[$method])) {
            return false;
        }


        $path = $request->getPath();
        foreach ($this->routes[$method] as $pattern => $handler) {
            if ($pattern === $path) {
                return $handler;
            }
        }

        return false;
    }
}