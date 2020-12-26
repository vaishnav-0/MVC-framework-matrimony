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

        $result = $this->$contact->getContact($this->$reqbody->id);

        if($result)
            $this->response->json((object) $result);
        
        else
            $this->response->json((object)["status"=>"failed"]);
    }

    public function edit(){
        
        $result = $this->$contact
            ->editContact(
                $this->$reqbody->id,
                $this->$reqbody->mobile,
                $this->$reqbody->mail,
                $this->$reqbody->landline
        );
        
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->response->json((object)["status"=>"failed"]);
    }
    
    public function add(){
        $result = $this->$contact
            ->addContact(
                $this->$reqbody->mobile,
                $this->$reqbody->mail,
                $this->$reqbody->landline
            );
        
        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->response->json((object)["status"=>"failed"]);
    }

    public function delete(Request $req, Response $res){

        $result = $this->$contact->deleteContact($this->$reqbody->id);

        if($result)
            $this->response->json((object)["status"=>"success"]);
        else
            $this->response->json((object)["status"=>"failed"]);

    }

}

?>