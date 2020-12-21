<?php
namespace Core;

class Dispacher{
    private $router;
    private $response;
    function __construct(Router $router, Response $response) {
        $this->router = $router;
        $this->response = $response;
    }

    function handle(Request $request) {
        $handler = $this->router->route($request);
        if (!$handler) {
            $this->response->setStatusCode(404);
            return;
        }

        $handler($request,$this->response);
    }
}

?>