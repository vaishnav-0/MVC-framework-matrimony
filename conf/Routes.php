<?php
namespace Conf;

use Core\Routing\Router;
use Matr\Controller\Auth;
use Matr\Controller\Contact;
use Matr\Controller\Member;
use Matr\Controller\Family;
use Matr\Controller\Sibling;
use Matr\Controller\Address;
use Matr\Controller\Religion;
use Matr\Controller\Dummy;
use Matr\Middleware\Auth as MiddleAuth;

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
        $router->group(['prefix'=>'member', 'middleware' => new MiddleAuth()], function ($group) {
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
        // address routes
        $router->get("address", [Address::class,"get"]);
        $router->post("address", [Address::class,"add"]);
        $router->patch("address", [Address::class,"edit"]);
        $router->delete("address", [Address::class,"delete"]);

        //dummy
        $router->get("dummy", [Dummy::class,"dummy"]);
        
        // sibling route
        $router->get("family/sibling", [Sibling::class,"getWFam"]);
        $router->delete("family/sibling", [Sibling::class,"deleteWFam"]);
        $router->get("sibling", [Sibling::class,"get"]);
        $router->post("sibling", [Sibling::class,"add"]);
        $router->post("sibling/add", [Sibling::class,"addBulk"]);
        $router->patch("sibling", [Sibling::class,"edit"]);
        $router->delete("sibling", [Sibling::class,"delete"]);

        //religion routes
        $router->get("religion/all", [Religion::class,"getAllReligion"]);
        $router->get("religion/caste", [Religion::class,"getAllCaste"]);


        return $router;
    }
}
