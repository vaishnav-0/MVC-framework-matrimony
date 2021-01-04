<?php
namespace Core;

class Dispacher{
    private $router;
    private $response;
    private $request;
    function __construct(Router $router, Request $req, Response $response) {
        $this->router = $router;
        $this->response = $response;
        $this->request = $req;

    }

    public function handle():Response {

        $handler = $this->router->route($this->request);
        if (!$handler) {
            return $this->response->withStatus(404);
        }
        return $this->call($handler);
    }

    public function call(array $handler){                
        $obj = new $handler[0]($this->request,$this->response);
        return call_user_func(array($obj, $handler[1]));
    }
}

?>