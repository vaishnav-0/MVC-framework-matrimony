<?php
namespace Core;
include_once(__DIR__."/Autoloader.php");
class main
{
    private static function init()   // sets the constansts(config)
    {
        include_once("../conf/Meta.php");
        include_once("../conf/Routes.php");
        session_start();
    }

    private static function autoload()
    {
        $loader = new Psr4autoloader;
        $loader->register();        // autoloader registering (NOTE:Autoloaded according to psr4 standards. Check /conf/Meta.php for Namespace mapping)
        $loader->loadDep();         // requre composer's index.php which autoloads dependencies
    }

    private static function Route()
    {
        $req = new Request;
        $router = \Conf\Routes::setRoutes();
        $response = new Response;
        $disp = new Dispacher($router,$req,$response);
        $disp->handle();
        $response->respond();
    }
    
    public function start()
    {
        self::init();
        self::autoload();   // can use autoloading after this
        self::Route();

    }
}