<?php
namespace Core;

class Dispacher{
    private $router;
    private $response;
    private $request;
    function __construct(Router $router, Response $response) {
        $this->router = $router;
        $this->response = $response;
    }

    public function handle(Request $request) {

        $handler = $this->router->route($request);
        if (!$handler) {
            $this->response->setStatusCode(404);
            return;
        }


        $this->call($handler,$request);
    }

    public function call(array $handler, Request $req){                 // Second param bad idea?
        $obj = new $handler[0]($req,$this->response);
        call_user_func(array($obj, $handler[1]));
    }
}

?>