<?php
namespace Core;

class Dispatcher{
    private $core;
    private $middlewares;
    function __construct($core,$middlewares) {
        $this->core = $core;
        $this->middlewares = $middlewares;
    }

    public function dispatch():Response{
        $onion = new Onion($this->middlewares);
        return $onion->peel(new Request,new Response,$this->core);
    }
}

?>