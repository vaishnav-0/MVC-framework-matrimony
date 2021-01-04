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
        $loader->register();        // autoloader registering (NOTE:Autoloaded according to psr4. Check /conf/Meta.php for Namespace mapping)
        $loader->loadDep();         // requre composer's index.php which autoloads dependencies
    }

    private static function Route()
    {
        $req = new Request;
        $router = \Conf\Routes::setRoutes(new Router);
        $response = new Response;
        $disp = new Dispacher($router,$req,$response);
        return $disp->handle();
        $response->respond();
    }
    private static function respond(Response $res){
        header($res->getProtocolVersion.' '.$res->getStatusCode.' '.$res->getReasonPhrase);
        foreach($res->getHeaders() as $feild=>$value){
            header($feild.':'.implode(',',$value));
        }
        if($body = $res->getBody())
            echo $body;
    }
    public function start()
    {
        self::init();
        self::autoload();   // can use autoloading after this
        $resp = self::Route();
        self::respond($resp);
    }
}