<?php
namespace Matr\Controller;
use Matr\Model\familyModel;
use Matr\Model\contactModel;
use Matr\Model\siblingModel;


class Family extends BaseController{
    private $familyModel;
    public function __construct($a,$b){
        parent::__construct($a,$b);
        $this->familyModel = new familyModel($this->con);

        $this->contactModel = new contactModel($this->con);
        $this->siblingModel = new siblingModel($this->con);


    }

    public function get(){
        $result = $this->familyModel->getFamily($this->reqBody->id);
        return $this->cntrlRespond($result, true);
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
        return $this->cntrlRespond($result);
    }
    
    public function add(){

        $famId = $this->familyModel     
            ->addFamily(
                        $this->reqBody->fName,
                        $this->reqBody->mName,
                        $this->reqBody->fCId,
                        $this->reqBody->mCId,
                        $this->reqBody->fOcc,
                        $this->reqBody->mOcc
                    );

        // can be simplified by calling contact controller here :|
        $mconId = $this->contactModel     
            ->addContact(
                        $this->reqBody->mmobile,
                        $this->reqBody->mmail,
                        $this->reqBody->mlandline
                    );
        $fconId = $this->contactModel     
            ->addContact(
                        $this->reqBody->fmobile,
                        $this->reqBody->fmail,
                        $this->reqBody->flandline
                    );
        $res = $this->familyModel->updateFamilyContact($famId,$fconId,$mconId);
        if(res == 1){
            return $this->cntrlRespond(true);
        }
        else
            return $this->cntrlRespond(false);
    }

    public function delete(){
        $result = $this->$familyModel->deleteFamily($this->$reqbody->id);
        return $this->cntrlRespond($result);


    }

}

?>