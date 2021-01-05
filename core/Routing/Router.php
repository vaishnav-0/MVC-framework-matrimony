<?php
namespace Core\Routing;
use Core\Request;
use Core\Dispatcher;
class Router
{
    use VerbShortcutsTrait;

    protected $routes = [];
    protected $baseMiddleware = [];

    private function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }
    
    public function map(array $verbs, string $uri, $callback): Route
    {
        // Force all verbs to be uppercase
        $verbs = array_map('strtoupper', $verbs);

        $route = new Route($verbs, $uri, $callback);

        $this->addRoute($route);

        return $route;
    }
    public function get($pattern,array $handler) {
        return $this->map(['GET'],$pattern,$handler);
    }
    public function post($pattern, array $handler) {
        return $this->map(['POST'],$pattern,$handler);
    }
    public function patch($pattern, array $handler) {
        return $this->map(['PATCH'],$pattern,$handler);
    }
    public function delete($pattern, array $handler) {
        return $this->map(['DELETE'],$pattern,$handler);
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
    public function match(Request $request)
    {
        foreach($this->routes as $route){
            $uri = $route->getUri();
            $methods = $route->getMethods();
            if($request->getPath() == $uri && in_array($request->getMethod(),$methods)){
                $this->currentRoute = $route;

                return $this->handle($route, $request);
            }
        }

      
    }
    protected function handle($route, $request)
    {
        if (count($this->baseMiddleware) === 0) {
            return $route->handle($request, $params);
        }

        // Apply all the base middleware and trigger the route handler as the last in the chain
        $middlewares = array_merge($this->baseMiddleware, $route->gatherMiddlware);

        // Create and process the dispatcher
        $dispatcher = new Dispatcher($route->getAction(),$middlewares);


        return $dispatcher->dispatch($request);
    }
  
    public function group($params, $callback) : Router
    {
        $group = new RouteGroup($params, $this);

        call_user_func($callback, $group);

        return $this;
    }
    public function getRoutes()
    {
        return $this->routes;
    }
}