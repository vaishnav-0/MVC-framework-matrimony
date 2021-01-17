<?php
namespace Matr\Controller;
use Matr\Model\userModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class Auth extends BaseController{
    
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->userModel = new userModel();

    }
    public function login(){
        $login = $this->userModel->login($this->reqBody->username,$this->reqBody->password);
        if($login === 1){
            $_SESSION['Auth'] = true;
            return $this->response->json(['status' => 'success']);
        }
        else {
            return $this->response->json(['status' => 'failed']);
        }
    }

    public function logout(){
        session_unset();
        return $this->response->json(['status' => 'Success']);
    }
    public function register(){
        $regObj = new userModel($conn);
        $register = $regObj->register($this->reqBody->username,$this->reqBody->password,'1');
        if($register){
            return $this->response->json((object)["status" => "Success","messages"=>"User Added"]);
        }
        else {
            return $this->response->json((object)["status" => "Failed","messages"=>"Failed"]);
        }
    }

}

?>