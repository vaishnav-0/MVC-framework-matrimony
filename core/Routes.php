<?php
namespace Core;
use Matr\Controller\Auth;
use Matr\Controller\Contact;
use Matr\Controller\Member;
use Matr\Controller\Family;

class Routes extends Router{
    public static function setRoutes(){                             
        // set your routes here

        //authentication routes
        Router::post("login",[Auth::class,"login"]);
        Router::get("logout",[Auth::class,"logout"]);
        Router::post("register",[Auth::class,"register"]);

        // member routes
        Router::get("member",[Member::class,"get"]);
        Router::get("member/all",[Member::class,"getAll"]);
        Router::post("member",[Member::class,"add"]);
        Router::patch("member",[Member::class,"edit"]);
        Router::delete("member",[Member::class,"delete"]);

        // family routes
        Router::get("family",[Family::class,"get"]);
        Router::post("family",[Family::class,"add"]);
        Router::patch("family",[Family::class,"edit"]);
        Router::delete("family",[Family::class,"delete"]);

        // contact routes
        Router::get("contact",[Contact::class,"get"]);
        Router::post("contact",[Contact::class,"add"]);
        Router::patch("contact",[Contact::class,"edit"]);
        Router::delete("contact",[Contact::class,"delete"]);

    }
}