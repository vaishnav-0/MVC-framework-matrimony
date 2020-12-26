<?php
namespace Matr\Controller;
use Matr\Model\memberModel;
class Member extends BaseController{
    
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->userModel = new memberModel($this->con);
    }
    public function addMember(){
        
    }

    public function editMember(){

    }

    public function getMember(){

    }

    public function deleteMember(){

    }

}

?>