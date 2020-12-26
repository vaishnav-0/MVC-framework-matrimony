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

    public function handle() {

        $handler = $this->router->route($this->request);
        if (!$handler) {
            $this->response->setStatusCode(404);
            return;
        }


        $this->call($handler);
    }

    public function call(array $handler){                 // Second param bad idea?
        $obj = new $handler[0]($this->request,$this->response);
        call_user_func(array($obj, $handler[1]));
    }
}

?>