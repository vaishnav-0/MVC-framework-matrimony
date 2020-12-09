<?php
//configure this before running
define("DS", "/");
        
define("ROOT", $_SERVER['DOCUMENT_ROOT']."/matrimony/");            //define where your app root is

define("APP_PATH", ROOT . "App" . DS);

define("MAIN_PATH", ROOT . "main" . DS);

define("PUBLIC_PATH", ROOT . "public" . DS);


define("CONFIG_PATH", APP_PATH . "config" . DS);

define("CONTROLLER_PATH", APP_PATH . "controller" . DS);

define("MODEL_PATH", APP_PATH . "Model" . DS);

define("VIEW_PATH", APP_PATH . "View" . DS);


define("CORE_PATH", MAIN_PATH . "Core" . DS);

define('DB_PATH', MAIN_PATH . "database" . DS);

define("HELPER_PATH", MAIN_PATH."helpers".DS);

define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS); 

define("NAMESPACE_MAP",array(
    'Matr\Controller' => APP_PATH."Controller"
));
?>