<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class Contact extends BaseController{
    public function __construct($a,$b){
        parent::__construct($a,$b);
    }
    public function getContact(){


    }
    public function editContact(){
 

    }
    public function addContact(){
        $conn = Connection::GetCon();
        $reqbody = $this->request->body;
        $contact = new contactModel($conn);
        $added = $contact->addContact($reqbody->mobile,$reqbody->mail,$reqbody->landline);
        if($added)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->resonse->json((object)["status"=>"failed"]);
    }
    public function deleteContact(Request $req, Response $res){


    }

}

?>