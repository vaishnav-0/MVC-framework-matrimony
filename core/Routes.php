<?php
namespace Core;
use Matr\Controller\Auth;
use Matr\Controller\Contact;
use Matr\Controller\Member;
class Routes extends Router{
    public static function setRoutes(){                             
        // set your routes here

        //authentication routes
        Router::post("login",[Auth::class,"login"]);
        Router::get("logout",[Auth::class,"logout"]);
        Router::post("register",[Auth::class,"register"]);

        // member routes
        Router::get("member",[Member::class,"get"]);
        Router::post("member",[Member::class,"add"]);
        Router::patch("member",[Member::class,"edit"]);
        Router::delete("member",[Member::class,"delete"]);

        // contact routes
        Router::get("contact",[Contact::class,"get"]);
        Router::post("contact",[Contact::class,"add"]);
        Router::patch("contact",[Contact::class,"edit"]);
        Router::delete("contact",[Contact::class,"delete"]);

    }
}