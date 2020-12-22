<?php
namespace Core;
class Routes extends Router{
    public static function setRoutes(){                             // set your routes here
        Router::get("auth","Matr\\Controller\\auth::testfunc");
        Router::get("contact","Matr\\Controller\\contact::testfunc");

        // contact routes
        Router::get("contact","Matr\\Controller\\contact::getContact");
        Router::post("contact","Matr\\Controller\\contact::addContact");
        Router::patch("contact","Matr\\Controller\\contact::editContact");
        Router::delete("contact","Matr\\Controller\\contact::deleteContact");

    }
}