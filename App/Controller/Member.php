<?php
namespace Matr\Controller;
use Matr\Model\memberModel;
use Matr\Model\contactModel;

use Matr\Helper\imageUploader;
class Member extends BaseController{
    private $memberModel;
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->memberModel = new memberModel($this->con);
    }

    // this is purely experimental

    public function get(){
        $result = $this->memberModel->getMember($this->reqBody->id);
        $this->cntrlRespond($result, true);
    }

    public function getAll(){
        $result = $this->memberModel->getAllMember();
        $this->cntrlRespond($result, true);
    }

    public function edit(){
        $result = $this->$memberModel->editMember();
        $this->cntrlRespond($result);
    }
    
    public function add(){
        $imageUploader = new imageUploader;
        $image = $imageUploader->addImage($_FILES['photo'],$this->reqBody->name);
        $memId = $this->memberModel     
            ->addMember($this->reqBody->join_date,
                        $this->reqBody->name,
                        $this->reqBody->dob,
                        $this->reqBody->caste_rel_id,
                        $this->reqBody->height,
                        $this->reqBody->physique,
                        $this->reqBody->gender,
                        $this->reqBody->occupation,
                        $this->reqBody->qualification,
                        $image,
                        $this->reqBody->complexion
                    );
        $conId = $this->contactModel     
            ->addContact(
                        $this->reqBody->mobile,
                        $this->reqBody->mail,
                        $this->reqBody->landline
                    );
        $result = $this->updateMemberContact($memId,$conId);
        $this->cntrlRespond($result);

    }

    public function delete(){
        $result = $this->$memberModel->deleteMember($this->$reqbody->id);
        $this->cntrlRespond($result);


    }

}

?>