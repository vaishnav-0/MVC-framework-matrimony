<?php

namespace Core;

use \Closure;

interface MiddleLayerInterface {

    public function handle(Request $req,Response $res, Closure $next):Response;

}