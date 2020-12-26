<?php
namespace Core;
use Matr\Controller\Auth;
use Matr\Controller\Contact;
class Routes extends Router{
    public static function setRoutes(){                             
        // set your routes here

        //authentication routes
        Router::get("login",[Auth::class,"login"]);
        Router::get("logout",[Auth::class,"loginout"]);
        Router::post("register",[Auth::class,"register"]);


        // contact routes
        Router::get("contact",[Contact::class,"getContact"]);
        Router::post("contact",[Contact::class,"addContact"]);
        Router::patch("contact",[Contact::class,"editContact"]);
        Router::delete("contact",[Contact::class,"deleteContact"]);

    }
}