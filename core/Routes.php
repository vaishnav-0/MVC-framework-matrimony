<?php
namespace Core;
class Routes extends Router{
    public static function setRoutes(){                             // set your routes here
        Router::get("abcd","Matr\\Controller\\auth::testfunc");
    }
}