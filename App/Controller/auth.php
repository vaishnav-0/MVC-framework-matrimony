<?php
namespace Matr\Controller;
use Matr\Model\dbModel\contactModel;
use Core\Request;
use Core\Response;
class auth{
    
    public static function testfunc(Request $req, Response $res){
        $res->json((object)["message"=>$req->body->msg]);
    }

}

?>