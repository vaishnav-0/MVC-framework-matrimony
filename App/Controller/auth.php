<?php
namespace Matr\Controller;
use Core\Request;
use Core\Response;
class auth{
    
    public static function login(Request $req, Response $res){
        if($login)
            $res->json((object)["messages"=>$req->body->msg]);
        else 
            $res->json((object)["messages"=>"No messages"]);
    }

    public static function logout(Request $req, Response $res){

    }
    public static function register(Request $req, Response $res){
 
    }

}

?>