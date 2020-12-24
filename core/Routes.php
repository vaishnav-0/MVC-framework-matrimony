<?php
namespace Core;
class Routes extends Router{
    public static function setRoutes(){                             
        // set your routes here

        //authentication routes
        Router::get("login","Matr\\Controller\\auth::login");
        Router::get("logout","Matr\\Controller\\auth::logout");
        Router::post("register","Matr\\Controller\\auth::register");


        // contact routes
        Router::get("contact","Matr\\Controller\\contact::getContact");
        Router::post("contact","Matr\\Controller\\contact::addContact");
        Router::patch("contact","Matr\\Controller\\contact::editContact");
        Router::delete("contact","Matr\\Controller\\contact::deleteContact");

    }
}