<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class Contact extends BaseController{
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->con = Connection::GetCon();
    }

    // this is purely experimental

    public function getContact(){
        $reqbody = $this->request->body;
        $contact = new contactModel($this->con);
        $result = $contact->addContact($reqbody->id);
        if($result)
            $this->response->json((object) $result);
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