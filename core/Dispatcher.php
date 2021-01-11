<?php
namespace Core;

class Dispatcher{
    private $core;
    private $middlewares;
    function __construct($core,$middlewares) {
        $this->core = $core;
        $this->middlewares = $middlewares;
    }

    public function dispatch(Request $request):Response{
        $onion = new Onion($this->middlewares);
        return $onion->peel($request,new Response,$this->core);
    }
}

?>