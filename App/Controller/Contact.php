<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class Contact{
    
    public function getContact(Request $req, Response $res){


    }
    public function editContact(Request $req, Response $res){
 

    }
    public function addContact(Request $req, Response $res){
        $conn = Connection::GetCon();
        $reqbody = $req->body;
        $contact = new contactModel($conn);
        $added = $contact->addContact($reqbody->mobile,$reqbody->mail,$reqbody->landline);
        if($added)
            $res->json((object)["status"=>"success"]);
        else
            $res->json((object)["status"=>"failed"]);
    }
    public function deleteContact(Request $req, Response $res){


    }

}

?>