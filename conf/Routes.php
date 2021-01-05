<?php
namespace Conf;

use Core\Routing\Router;
use Matr\Controller\Auth;
use Matr\Controller\Contact;
use Matr\Controller\Member;
use Matr\Controller\Family;
use Matr\Middleware\middlewareTest;

class Routes
{
    public static function setRoutes(Router $router)
    {
        // set your routes here

        //authentication routes
        $router->post("login", [Auth::class,"login"]);
        $router->get("logout", [Auth::class,"logout"]);
        $router->post("register", [Auth::class,"register"]);

        // member routes
        $router->group(['prefix'=>'member'], function ($group) {
            $group->get("", [Member::class,"get"]);
            $group->get("all", [Member::class,"getAll"]);
            $group->post("", [Member::class,"add"]);
            $group->patch("", [Member::class,"edit"]);
            $group->delete("", [Member::class,"delete"]);
        });

        // family routes
        $router->get("family", [Family::class,"get"]);
        $router->post("family", [Family::class,"add"]);
        $router->patch("family", [Family::class,"edit"]);
        $router->delete("family", [Family::class,"delete"]);
        
        // contact routes
        $router->get("contact", [Contact::class,"get"]);
        $router->post("contact", [Contact::class,"add"]);
        $router->patch("contact", [Contact::class,"edit"]);
        $router->delete("contact", [Contact::class,"delete"]);
        return $router;
    }
}
