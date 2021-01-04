<?php
namespace Conf;
use Core\Router;
use Matr\Controller\Auth;
use Matr\Controller\Contact;
use Matr\Controller\Member;
class Routes {
    public static function setRoutes(Router $router){   
        // set your routes here

        //authentication routes
        $router->post("login",[Auth::class,"login"]);
        $router->get("logout",[Auth::class,"logout"]);
        $router->post("register",[Auth::class,"register"]);

        // member routes
        $router->get("member",[Member::class,"get"]);
        $router->get("member/all",[Member::class,"getAll"]);
        $router->post("member",[Member::class,"add"]);
        $router->patch("member",[Member::class,"edit"]);
        $router->delete("member",[Member::class,"delete"]);

        // contact routes
        $router->get("contact",[Contact::class,"get"]);
        $router->post("contact",[Contact::class,"add"]);
        $router->patch("contact",[Contact::class,"edit"]);
        $router->delete("contact",[Contact::class,"delete"]);

        return $router;
    }
}
