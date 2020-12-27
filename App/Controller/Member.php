<?php
namespace Matr\Controller;
use Matr\Model\memberModel;
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

    public function edit(){
        $result = $this->$memberModel->editMember();
        $this->cntrlRespond($result);
    }
    
    public function add(){

        $result = $this->$memberModel
            ->addMember(
                        $this->reqBody->join_date,
                        $this->reqBody->name,
                        $this->reqBody->dob,
                        $this->reqBody->caste_rel_id,
                        $this->reqBody->height,
                        $this->reqBody->physique,
                        $this->reqBody->gender,
                        $this->reqBody->occupation,
                        $this->reqBody->qualification,
                        $this->reqBody->photo,
                        $this->reqBody->complexion
                    );

        $this->cntrlRespond($result);

    }

    public function delete(){
        $result = $this->$memberModel->deleteMember($this->$reqbody->id);
        $this->cntrlRespond($result);


    }

}

?>