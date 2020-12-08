<?php
include(ROOT."core/Request.php");
class main{
    //configure init() before running
private static function init() {

    define("DS", "/");
        
    define("APP_PATH", ROOT . "app" . DS);

    define("MAIN_PATH", ROOT . "main" . DS);

    define("PUBLIC_PATH", ROOT . "public" . DS);


    define("CONFIG_PATH", APP_PATH . "config" . DS);

    define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);

    define("MODEL_PATH", APP_PATH . "models" . DS);

    define("VIEW_PATH", APP_PATH . "views" . DS);


    define("CORE_PATH", MAIN_PATH . "core" . DS);

    define('DB_PATH', MAIN_PATH . "database" . DS);
    
    define("HELPER_PATH",MAIN_PATH."helpers".DS);

    define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);

    session_start();
}

    private static function autoload(){
            
    spl_autoload_register(array(__CLASS__,'load'));     //argument of spl_autoload_register is of callable type.

} 


//Custom load method

private static function load($classname){


    // Here simply autoload app’s controller and model classes

    if (substr($classname, -10 ) == "Controller"){

        // Controller
        require_once CURR_CONTROLLER_PATH . "$classname.php";

    } elseif (substr($classname, -5) == "Model"){

        // Model

        require_once  MODEL_PATH . "$classname.php";

    }

}
    private static function rd(Request $request){
        $controllerdir = $request->getDir();
        $controllername = $request->getController().'Controller';
        $methodname = $request->getMethod();
        if(is_readable("../app/controllers".DS.$controllerdir.DS.$controllername.'.php'))
        {
            $controller = new $controllername;
            $method =(is_callable(array($controller,$methodname)))?$methodname:'main';
            

                call_user_func(array($controller,$method));

        }
        else{
            $controller = new BaseController();
            $controller->main();
        }
            
    }
    public function start(){
        self::init();
        self::autoload();
        $req = new Request;
        self::rd($req);

    }
    
}

?>