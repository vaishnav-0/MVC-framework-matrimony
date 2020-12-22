<?php
namespace Matr\Controller;
use Matr\Model\contactModel;
use Matr\Model\dbModel\dbconn\dbmatrModel as Connection;
use Core\Request;
use Core\Response;
class contact{
    
    public static function getContact(Request $req, Response $res){


    }
    public static function editContact(Request $req, Response $res){
 

    }
    public static function addContact(Request $req, Response $res){
        $conn = Connection::GetCon();
        $reqbody = $req->body;
        $contact = new contactModel($conn);
        $added = $contact->addContact($reqbody->mobile,$reqbody->mail,$reqbody->landline);
        if($added)
            $res->json((object)["status"=>"success"]);
        else
            $res->json((object)["status"=>"failed"]);
    }
    public static function deleteContact(Request $req, Response $res){


    }

}

?>