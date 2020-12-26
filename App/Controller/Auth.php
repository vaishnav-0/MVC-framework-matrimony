<?php
namespace Matr\Controller;
use Matr\Model\userModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class Auth extends BaseController{
    
    public function __construct($a,$b){
        parent::__construct($a,$b);
    }
    public function login(){
      /*  $conn = Connection::GetCon();
        $reqbody = $req->body;
        $loginObj = new userModel($conn);
        $login = $loginObj->login($reqbody->username,$reqbody->password);
        if($login == 1){
            session_start();
            $res->json((object)["status"=>"Success"]);
        }
        else {
            $res->json((object)["status"=>"Failed"]);
        }*/
        echo "hello";
    }

    public function logout(Request $req, Response $res){
        session_unset();
        session_destroy();
        return;
    }
    public function register(Request $req, Response $res){
        $conn = Connection::GetCon();
        $reqbody = $req->body;
        $regObj = new userModel($conn);
        $register = $regObj->register($reqbody->username,$reqbody->password,NULL);
        if($register){
            $res->json((object)["messages"=>"User Added"]);
        }
        else {
            $res->json((object)["messages"=>"Failed"]);
        }
    }

}

?>