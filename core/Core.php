<?php
namespace Core;

use Core\Routing\Router;

include_once(__DIR__."/Autoloader.php");
class main
{
    private static function init()   // sets the constansts(config)
    {
        include_once("../conf/Meta.php");
        include_once("Polyfills.php");
        include_once("utils/functions.php");
        include_once("../conf/Routes.php");
        session_start();
    }

    private static function autoload()
    {
        $loader = new Psr4autoloader;
        $loader->register();        // autoloader registering (NOTE:Autoloaded according to psr4. Check /conf/Meta.php for Namespace mapping)
        $loader->loadDep();         // requre composer's index.php which autoloads dependencies
    }

    private static function Route($router)
    {
        $req = new Request;
        $req = $req->withUrl(Request::getReqUrl())->withMethod(Request::getReqMethod())->withPath(Request::getReqPath())->withParsedBody(Request::getReqBody());
        return $router->match($req);
    }
    private static function respond(Response $res)
    {
        header($res->getProtocolVersion().' '.$res->getStatusCode().' '.$res->getReasonPhrase());
        foreach ($res->getHeaders() as $feild=>$value) {
            header($feild.':'.implode(',', $value));
        }
        if ($body = $res->getBody()) {
            echo $body;
        }
    }
    public function start()
    {
        self::init();
        self::autoload();   // can use autoloading after this
        $router = \Conf\Routes::setRoutes(new Router);
        $resp = self::Route($router);
        self::respond($resp);
    }
}
