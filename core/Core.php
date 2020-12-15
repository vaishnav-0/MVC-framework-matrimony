<?php
namespace Core;

include_once(__DIR__."/Router.php");
include_once(__DIR__."/Autoloader.php");
class main
{
    private static function init()   // sets the constansts(config)
    {
        include_once("../conf/Meta.php");
        session_start();
    }

    private static function autoload()
    {
        $loader = new Psr4autoloader;
        $loader->register();        // autoloader registering (NOTE:Autoloaded according to psr4 standards. Check /conf/Met.php for Namespace mapping)
        $loader->loadDep();         // requre composer's index.php which autoloads dependencies
    }

    private static function Route()
    {
        
    }

    public function start()
    {
        self::init();
        self::autoload();
        self::Route();
    }
}