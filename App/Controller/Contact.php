<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
class Contact extends BaseController{
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->reqBody = $this->request->body;
    }

    // this is purely experimental

    public function getContact(){
        $contact = new contactModel($this->con);
        $result = $contact->getContact($this->reqBody->id);
        if ($result) {
            print_r($result);
            $this->response->json((object) $result);
        }
        else
            $this->resonse->json((object)["status"=>"failed"]);
    }

    public function editContact(){
        $reqbody = $this->request->body;
        $contact = new contactModel($this->con);
        $result = $contact->addContact($reqbody->id,$reqbody->mobile,$reqbody->mail,$reqbody->landline);
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->resonse->json((object)["status"=>"failed"]);
    }
    
    public function addContact(){
        $reqbody = $this->request->body;
        $contact = new contactModel($this->con);
        $result = $contact->addContact($reqbody->mobile,$reqbody->mail,$reqbody->landline);
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->resonse->json((object)["status"=>"failed"]);
    }

    public function deleteContact(Request $req, Response $res){
        $reqbody = $this->request->body;
        $contact = new contactModel($this->con);
        $result = $contact->addContact($reqbody->id);
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->resonse->json((object)["status"=>"failed"]);

    }

}

?>