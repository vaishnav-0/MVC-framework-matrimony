<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
class Contact extends BaseController{
    private $contactModel;
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $contactModel = new contactModel($this->con);
    }

    // this is purely experimental

    public function get(){
        $result = $this->contactModel->getContact($this->reqBody->id);
        if ($result) {
            print_r($result);
            $this->response->json((object) $result);
        }
        else
            $this->response->json((object)["status"=>"failed"]);
    }

    public function edit(){
        $result = $this->$contactModel->editContact($this->$reqbody->id,$this->$reqbody->mobile,$this->$reqbody->mail,$this->$reqbody->landline);
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->response->json((object)["status"=>"failed"]);
    }
    
    public function add(){
        $result = $this->$contactModel->addContact($this->$reqbody->mobile,$this->$reqbody->mail,$this->$reqbody->landline);
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->response->json((object)["status"=>"failed"]);
    }

    public function delete(Request $req, Response $res){
        $result = $this->$contactModel->deleteContact($this->$reqbody->id);
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->response->json((object)["status"=>"failed"]);

    }

}

?>