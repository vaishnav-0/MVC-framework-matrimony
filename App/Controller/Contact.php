<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
class Contact extends BaseController{
    private $contactModel;
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->contactModel = new contactModel($this->con);
    }

    // this is purely experimental

    public function get(){
        
        $result = $this->contactModel->getContact($this->reqBody->id);
        $this->cntrlRespond($result, true);
    }

    public function edit(){
        $result = $this->$contactModel->editContact($this->reqBody->id,$this->reqBody->mobile,$this->reqBody->mail,$this->reqBody->landline);
        $this->cntrlRespond($result);
    }
    
    public function add(){
        $result = $this->$contactModel->addContact($this->reqBody->mobile,$this->reqBody->mail,$this->reqBody->landline);
        $this->cntrlRespond($result);

    }

    public function delete(Request $req, Response $res){
        $result = $this->$contactModel->deleteContact($this->reqBody->id);
        $this->cntrlRespond($result);


    }

}

?>