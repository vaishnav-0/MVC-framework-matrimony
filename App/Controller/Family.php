<?php
namespace Matr\Controller;
use Matr\Model\familyModel;

class Family extends BaseController{
    private $familyModel;
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->familyModel = new familyModel($this->con);
    }

    public function get(){
        $result = $this->familyModel->getFamily($this->reqBody->id);
        $this->cntrlRespond($result, true);
    }


    public function edit(){
        $result = $this->$familyModel->editFamily(
                        $this->reqBody->fName,
                        $this->reqBody->mName,
                        $this->reqBody->fCId,
                        $this->reqBody->mCId,
                        $this->reqBody->fOcc,
                        $this->reqBody->mOcc
        );
        $this->cntrlRespond($result);
    }
    
    public function add(){

        $result = $this->familyModel     
            ->addFamily(
                        $this->reqBody->fName,
                        $this->reqBody->mName,
                        $this->reqBody->fCId,
                        $this->reqBody->mCId,
                        $this->reqBody->fOcc,
                        $this->reqBody->mOcc
                    );

        $this->cntrlRespond($result);

    }

    public function delete(){
        $result = $this->$familyModel->deleteFamily($this->$reqbody->id);
        $this->cntrlRespond($result);


    }

}

?>