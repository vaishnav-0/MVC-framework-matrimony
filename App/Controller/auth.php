<?php
namespace Matr\Controller;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class auth{
    
    public static function testfunc(Request $req, Response $res){
        if($req->body->msg)
            $res->json((object)["messages"=>$req->body->msg]);
        else 
            $res->json((object)["messages"=>"No messages"]);

    }

}

?>