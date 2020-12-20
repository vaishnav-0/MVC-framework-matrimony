<?php
namespace Core;

class Dispacher{
    private $router;

    function __construct(Router $router) {
        $this->router = $router;
    }

    function handle(Request $request) {
        $handler = $this->router->route($request);
        if (!$handler) {
            echo "Could not find your resource!\n";
            return;
        }

        $handler();
    }
}

?>