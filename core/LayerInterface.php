<?php

namespace Core;

use \Closure;

interface LayerInterface {

    public function handle($object, Closure $next);

}