<?php
namespace Core\Routing;
use Core\Request;
use Core\Response;
use Core\Dispatcher;
class Route
{
    private $uri;
    private $methods = [];
    private $routeAction;
    private $name;
    private $middleware = [];
    private $paramConstraints = [];
    private $controllerName = null;
    private $controllerMethod = null;

    public function __construct(
        array $methods,
        string $uri,
        $action
    ) {
        $this->methods = $methods;
        $this->setUri($uri);
        $this->setAction($action);
        $this->controllerName = $action[0];
        $this->controllerMethod = $action[1];
    }

    private function setUri($uri)
    {
        $this->uri = rtrim($uri, ' /');
    }

    private function setAction($action)
    {
        $this->routeAction = $this->RouteAction();
    }
    public function RouteAction()
    {
        return function(Request $req,Response $res){
            return call_user_func([new $this->controllerName($req,$res),$this->controllerMethod]);
        };
    }
    public function handle(Request $request) : Response
    {
        // Get all the middleware registered for this route
        $middlewares = $this->gatherMiddleware();

        // Create and process the dispatcher
        $dispatcher = new Dispatcher($this->getAction(),$middlewares);

        return $dispatcher->dispatch($request);
    }
    private function gatherMiddleware() : array
    {
        return $this->middleware;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function name(string $name)
    {
        if (isset($this->name)) {
            throw new RouteNameRedefinedException();
        }

        $this->name = $name;

        return $this;
    }

    public function getParamConstraints()
    {
        return $this->paramConstraints;
    }

    public function middleware()
    {
        $args = func_get_args();

        foreach ($args as $middleware) {
            if (is_array($middleware)) {
                $this->middleware += $middleware;
            } else {
                $this->middleware[] = $middleware;
            }
        }

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAction()
    {
        return $this->routeAction;
    }
}
