<?php
namespace Matr\Controller;
use Matr\Model\userModel;
class Member extends BaseController{
    
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->userModel = new userModel($this->con);
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