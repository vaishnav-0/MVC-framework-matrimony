<?php
namespace Core;

include_once(__DIR__."/Router.php");
include_once(__DIR__."/Autoloader.php");
class main
{
    private static function init()
    {                
        include_once("../conf/Meta.php");
        session_start();
    }

    private static function autoload(){

       $loader = new Psr4autoloader;
        $loader->register;    

      }

    private static function Route()
    {
        $rt = new Router;
        $controller = $rt->getController();
        $method = $rt->getMethod();
        $custloader = new CustomCheck;
        if ($custloader->check("Matr\\Controller\\".$controller)){
        } 
        else {

        }
    }

    public function start()
    {
        self::init();
        self::autoload();
        self::Route();
    }
}
