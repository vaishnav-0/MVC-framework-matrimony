<?php
namespace Matr\Controller;
use Matr\Model\authModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class auth{
    
    public static function login(Request $req, Response $res){
        $conn = Connection::GetCon();
        $reqbody = $req->body;
        $loginObj = new authModel($conn);
        $login = $loginObj->login($reqbody->username,$reqbody->password);
        if($login == 1){
            session_start();
            $res->json((object)["messages"=>"Success"]);
        }
        else {
            $res->json((object)["status"=>"Failed"]);
        }
    }

    public static function logout(Request $req, Response $res){
        session_unset();
        session_destroy();
        return;
    }
    public static function register(Request $req, Response $res){
 
    }

}

?>