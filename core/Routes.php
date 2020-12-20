<?php
namespace Core;
class Routes extends Router{
    public static function setRoutes(){                             // set your routes here
        Router::get("auth","Matr\\Controller\\auth::testfunc");
    }
}